<?php

namespace App\Http\Controllers\Payroll\JsonControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DateTime;

use App\Models\EmployeeDetail;
use App\Models\UserDetail;
use App\Models\CashAdvance;
use App\Models\Attendance;
use App\Models\Deduction;
use App\Models\MultiPay;
use App\Models\Overtime;
use App\Models\Bonus;
use App\Models\Contributions;
use App\Models\ApplicantDetail;
use App\Models\Holiday;
use App\Models\holiday_attendance;
use App\Models\Leave;
use App\Models\Pagibig;
use App\Models\philhealth;
use App\Models\Audit;
use App\Models\overtime_approval;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Throwable;

class PayrollJSONController extends Controller
{
/*=============================================================================
|                                 START
|                         Cash Advance JSON
|
*==============================================================================*/

    public function CashAdvance(Request $request){
        $cashAdvanceRecord = CashAdvance::join('employee_details', 'cash_advances.employee_id','=','employee_details.employee_id')
            ->join('user_details', 'employee_details.information_id','=', 'user_details.information_id')
            ->whereBetween('cash_advances.cash_advance_date',[$request->from_date,new DateTime($request->to_date ." ". "23:59")])
            ->get();

            return datatables()->of($cashAdvanceRecord)
                ->addColumn('delete',function($data){
                $button = ' <form action="/removeCashAdvance/'. $data->cashAdvances_id .'" onsubmit="return confirm(\'Do you really want to delete cash advance #'. $data->cashAdvances_id .'?\');" method="GET">
                            <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="h2 bi bi-trash"></i><br>Remove</button>
                            </form>';
                return $button;
                })
                ->addColumn('payroll_manager',function($data){
                    $pr_manager = UserDetail::where('login_id',$data->payrollManager_id)->first();
                    return "$pr_manager->fname $pr_manager->mname $pr_manager->lname";
                })
                ->addColumn('added_on',function($data){
                    return date_format($data->created_at,"Y/m/d H:i:s");
                })
                ->rawColumns(['delete','payroll_manager','added_on'])
                ->make(true);
    }

/*=============================================================================
|                                   END
*==============================================================================*/





/*=============================================================================
|                                 START
|                         EmployeeDetails JSON
|
*==============================================================================*/

    public function EmployeeDetails(){
        $employeeDetails = EmployeeDetail::with('UserDetail')->get();
        return datatables()->of($employeeDetails)->addColumn('select',function($data){
            $button = '<button type="button"
            onclick="selectEmployee(
                this,
                \''. $data->employee_id. '\',
                \''. $data->userDetail->picture . '\',
                \''. addslashes($data->userDetail->fname) . ' ' . addslashes($data->userDetail->mname) . ' ' . addslashes($data->userDetail->lname) .'\',
                \''. addslashes($data->department) .'\',
                \''. addslashes($data->position) .'\',
                \''. $data->rate .'\'
                )" class="btn btn-outline-primary">Select</button>';
            return $button;
        })
        ->rawColumns(['select'])
        ->make(true);
    }

/*=============================================================================
|                                   END
*==============================================================================*/




/*=============================================================================
|                                 START
|                             Deduction JSON
|
*==============================================================================*/

    public function Deduction(Request $request){
        $deductions = Deduction::join('employee_details','employee_details.employee_id','=', 'deductions.employee_id')
            ->join('user_details','user_details.information_id','=','employee_details.information_id')
            ->whereDate('deductions.deduction_start_date','<=',$request->to_date)
            ->WhereDate('deductions.deduction_end_date','>=',$request->from_date)
            ->get();

        return datatables()->of($deductions)
            ->addColumn('delete',function($data){
                $button = ' <form action="/removeDeduction/'.$data->deduction_id.'" onsubmit="return confirm(\'Do you really want to delete deduction #'.$data->deduction_id.'?\');" method="GET">
                            <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="h2 bi bi-trash"></i><br>Remove</button>
                            </form>';
                return $button;
            })
            ->addColumn('payroll_manager',function($data){
                $pr_manager = UserDetail::where('login_id',$data->payrollManager_id)->first();
                return "$pr_manager->fname $pr_manager->mname $pr_manager->lname";
            })
            ->addColumn('added_on',function($data){
                return date_format($data->created_at,"Y/m/d H:i:s");
            })
            ->rawColumns(['delete','payroll_manager','added_on'])
            ->make(true);
    }

    public function fetchSingleEmployee(Request $request){
        return $employeeDetails = EmployeeDetail::where('employee_id',$request->employee_id)->with('UserDetail')->first();
    }

/*=============================================================================
|                                   END
*==============================================================================*/




/*=============================================================================
|                                 START
|                             Overtime JSON
|
*==============================================================================*/

    public function Overtime(Request $request){
        $employee_schedules = EmployeeDetail::all();
        $employee_overtime_arr =[];

        foreach ($employee_schedules as $key => $employee) {
                $stimeout = $this->timeCalculator($employee->schedule_Timeout);
                // Add 30 mins for minimum overtime
                $stimeout += $request->time_filter;


            $temp = Attendance::where('employee_id',$employee->employee_id)
                ->whereBetween('attendance_date',[$request->from_date,new DateTime($request->to_date ." ". "23:59:59")])
                ->whereBetween('time_in',['00:00:00',$employee->schedule_Timein])
                ->whereBetween('time_out',[date('H:i:s',$stimeout),'24:00:00'])
                ->get();


            foreach ($temp as $key => $value) {
                $value->approval = overtime_approval::where('attendance_id',$value->attendance_id)->first();
                if($value->approval){
                    if(!isset($value->approval->status)){
                        array_push($employee_overtime_arr,$value);
                    }
                }else{
                    array_push($employee_overtime_arr,$value);
                }
            }
        }

        foreach ($employee_overtime_arr as $key => $employee) {
            $employee->user_details = EmployeeDetail::where('employee_id', $employee->employee_id)
                ->join('user_details','user_details.information_id','=','employee_details.information_id')
                ->first();

                try{
                    $timeout = $this->timeCalculator($employee->time_out);
                    $stimeout = $this->timeCalculator($employee->user_details->schedule_Timeout);

                }catch(Throwable $t){
                    return $employee;
                }

                $employee->total_overtime_hours = round(($timeout - $stimeout) / 3600,2);
        }

        return datatables()->of($employee_overtime_arr)->make(true);
    }

    public function DeniedOvertime(){
        $overtime = overtime_approval::where('status',0)->get();
        foreach ($overtime as $key => $value) {
            $value->employee = EmployeeDetail::with('UserDetail')->where('employee_id',$value->employee_id)->first();
            $value->manager = UserDetail::where('login_id',$value->approver_id)->first();
            $value->attendance = Attendance::where('attendance_id',$value->attendance_id)->first();
        }

        return datatables()->of($overtime)
            ->addColumn('payroll_manager',function($data){
                $pr_manager = UserDetail::where('login_id',$data->approver_id)->first();
                return "$pr_manager->fname $pr_manager->mname $pr_manager->lname";
            })
            ->rawColumns(['payroll_manager'])
            ->make(true);
    }

    public function getPaidOvertime(){
        $paid_overtime_arr = Overtime::join('attendances','attendances.attendance_id','=','overtimes.attendance_id')
            ->join('employee_details','employee_details.employee_id','=','overtimes.employee_id')
            ->join('user_details','user_details.information_id','=','employee_details.information_id')
            ->get();

        foreach ($paid_overtime_arr as $key => $employee) {
            $employee->user_details = EmployeeDetail::where('employee_id', $employee->employee_id)
                ->join('user_details','user_details.information_id','=','employee_details.information_id')
                ->first();

            $timeout = $this->timeCalculator($employee->time_out);
            $stimeout = $this->timeCalculator($employee->user_details->schedule_Timeout);

            $employee->total_overtime_hours = round(($timeout - $stimeout) / 3600,2);
            $employee->approval = overtime_approval::where('attendance_id',$employee->attendance_id)->first();
        }
        return datatables()->of($paid_overtime_arr)
            ->addColumn('payroll_manager',function($data){
                $pr_manager = UserDetail::where('login_id',$data->payrollManager_id)->first();
                return "$pr_manager->fname $pr_manager->mname $pr_manager->lname";
            })
            ->addColumn('added_on',function($data){
                return date_format($data->created_at,"Y/m/d H:i:s");
            })
            ->rawColumns(['payroll_manager','added_on'])
            ->make(true);
    }

/*=============================================================================
|                                   END
*==============================================================================*/




/*=============================================================================
|                                 START
|                               Bonus JSON
|
*==============================================================================*/

    public function Bonus(Request $request){
        $BonusRecords = Bonus::join('employee_details', 'bonuses.employee_id','=','employee_details.employee_id')
            ->join('user_details', 'employee_details.information_id','=', 'user_details.information_id')
            ->whereBetween('bonuses.bonus_date',[$request->from_date,new DateTime($request->to_date ." ". "23:59")])
            ->get();

        return datatables()->of($BonusRecords)
            ->addColumn('delete',function($data){
            $button = ' <form action="/removeDeleteBonus/'. $data->bonus_id .'" onsubmit="return confirm(\'Do you really want to delete bonus #'. $data->bonus_id .'?\');" method="GET">
                        <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="h2 bi bi-trash"></i><br>Remove</button>
                        </form>';
            return $button;
            })
            ->addColumn('payroll_manager',function($data){
                $pr_manager = UserDetail::where('login_id',$data->payrollManager_id)->first();
                return "$pr_manager->fname $pr_manager->mname $pr_manager->lname";
            })
            ->addColumn('added_on',function($data){
                return date_format($data->created_at,"Y/m/d H:i:s");
            })
            ->rawColumns(['delete','payroll_manager','added_on'])
            ->make(true);
    }

/*=============================================================================
|                                   END
*==============================================================================*/





/*=============================================================================
|                                 START
|                          fetch Attedance JSON
|
*==============================================================================*/

    public function fetchAttedance(Request $request){
        $attendance = Attendance::join('employee_details','employee_details.employee_id','=','attendances.employee_id')
            ->join('user_details', 'employee_details.information_id','=', 'user_details.information_id')
            ->whereBetween('attendances.attendance_date',[$request->from_date,new DateTime($request->to_date ." ". "23:59")])
            ->get();

        $normal_pay_attendance = [];
        foreach ($attendance as $key => $value) {
            if(MultiPay::where('attendance_id',$value->attendance_id)->first()){
            }else{
                array_push($normal_pay_attendance,$value);
            }
        }

        foreach ($normal_pay_attendance as $key => $value) {
            $value->overtime = Overtime::where('attendance_id',$value->attendance_id)->first();

            $timein = $this->timeCalculator($value->time_in);
            $timeout = $this->timeCalculator($value->time_out);

            $stimein = $this->timeCalculator($value->schedule_Timein);
            $stimeout = $this->timeCalculator($value->schedule_Timeout);

            if($value->overtime){
                $value->total_hours = round(($timeout - $stimein) / 3600,2);
            }else{
                $value->total_hours = round(($stimeout - $stimein) / 3600,2);
            }

            if($timeout < $stimeout){
                $value->under = 1;
                $value->total_hours =  round(($timeout - $stimein) / 3600,2);
            }

            if($timein > $stimein){
                $value->late = 1;
                $value->total_hours =  round(($timeout - $stimein) / 3600,2);
            }
        }

        return datatables()->of($normal_pay_attendance)->make(true);
    }

/*=============================================================================
|                                   END
*==============================================================================*/




/*=============================================================================
|                                 START
|                           Double Pay JSON
|
*==============================================================================*/

    public function DoublePay(Request $request){
        $multipay = MultiPay::join('employee_details','employee_details.employee_id','=','multi_pays.employee_id')
            ->join('attendances','attendances.attendance_id','=','multi_pays.attendance_id')
            ->join('user_details', 'employee_details.information_id','=', 'user_details.information_id')
            ->whereBetween('attendances.attendance_date',[$request->from_date,new DateTime($request->to_date ." ". "23:59")])
            ->get();

        foreach ($multipay as $key => $value) {
            $value->overtime = Overtime::where('attendance_id',$value->attendance_id)->first();

            $timein = $this->timeCalculator($value->time_in);
            $timeout = $this->timeCalculator($value->time_out);

            $stimein = $this->timeCalculator($value->schedule_Timein);
            $stimeout = $this->timeCalculator($value->schedule_Timeout);

            if($timeout < $stimeout){
                $value->under = 1;
            }

            if($timein > $stimein){
                $value->late = 1;
            }


            if($value->overtime){
                $value->total_hours = round(($timeout - $timein) / 3600,2);
                $value->total_compensation = round($value->rate * $value->total_hours * $value->status,2);
            }else{
                if($value->under || $value->late){
                    $value->total_hours = round(($timeout - $timein) / 3600,2);
                    $value->total_compensation = round($value->rate * $value->total_hours * $value->status,2);
                }else{
                    $value->total_hours = round(($stimeout - $stimein) / 3600,2);
                    $value->total_compensation = round($value->rate * $value->total_hours * $value->status,2);
                }
            }
        }

        return datatables()->of($multipay)
            ->addColumn('delete',function($data){
            $button = ' <form action="/removeMultiPay/'. $data->multi_pay_id .'" onsubmit="return confirm(\'Do you really want to delete multi pay #'. $data->multi_pay_id .'?\');" method="GET">
                        <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="h2 bi bi-trash"></i><br>Remove</button>
                        </form>';
            return $button;
            })
            ->addColumn('payroll_manager',function($data){
                $pr_manager = UserDetail::where('login_id',$data->payrollManager_id)->first();
                return "$pr_manager->fname $pr_manager->mname $pr_manager->lname";
            })
            ->addColumn('added_on',function($data){
                return date_format($data->created_at,"Y/m/d H:i:s");
            })
            ->rawColumns(['delete','payroll_manager','added_on'])
            ->make(true);
    }

/*=============================================================================
|                                   END
*==============================================================================*/





/*=============================================================================
|                                 START
|                           Contributions JSON
|
*==============================================================================*/

    public function contributions(Request $request){
        $employee_details = EmployeeDetail::join('user_details','user_details.information_id','=','employee_details.information_id')
            ->get();

        foreach ($employee_details as $key => $employee) {
            $employee->attendance = $employee->FilteredAttendance($employee->employee_id, $request->from_date,$request->to_date);
        }

        foreach ($employee_details as $key => $detail) {
            // Computation for total hours
            $detail->complete_hours = 0;
            //Gross pay computation
            $detail->gross_pay = 0;
            //Computes total time and gross pay with overtime and multipay
            foreach ($detail->attendance as $key => $attendance) {
                $overtime = Overtime::where('attendance_id',$attendance->attendance_id)->first();
                $sched = EmployeeDetail::where('employee_id',$attendance->employee_id)->first();
                $multipay = MultiPay::where('attendance_id',$attendance->attendance_id)->first();

                $timein = $this->timeCalculator($attendance->time_in);
                $timeout = $this->timeCalculator($attendance->time_out);

                $stimein = $this->timeCalculator($sched->schedule_Timein);
                $stimeout = $this->timeCalculator($sched->schedule_Timeout);
                $rate = $sched->rate;

                if($multipay){
                    $rate = $rate * $multipay->status;
                }

                if($overtime){
                    $time = ($timeout - $timein) / 3600;

                    $detail->gross_pay += $rate * $time;
                    $detail->complete_hours += round($time,2);
                }else{
                    $time = ($stimeout - $stimein) / 3600;

                    $detail->gross_pay += $rate * $time;
                    $detail->complete_hours += round($time,2);
                }

                $detail->gross_pay = round($detail->gross_pay,2);

                $detail->complete_hours = round($detail->complete_hours,2);
            }

            // SSS Contribution
            $detail->employer_contribution = 0;
            $detail->employee_contribution = 0;

            $start = 3000;
            $gross_pay = $detail->gross_pay;
            $er_add = 0;

            $sss_rate = Contributions::first();

            $ee_rate = $sss_rate->employee_contribution / 100;
            $er_rate = $sss_rate->employer_contribution / 100;

            // Check Additional for ER
            if($gross_pay < $sss_rate->high_limit){$er_add = $sss_rate->add_low;}
            else{$er_add = $sss_rate->add_high;}

            while(1){
                if($gross_pay == 0){
                    $start = 0;
                    $er_add = 0;
                    break;
                }
                if($gross_pay < 3001){
                    break;
                }
                $start += 500;
                if($gross_pay >= $start - 250  && $gross_pay <= $start + 249){
                    break;
                }
                if($gross_pay >= 25000){
                    $start = 25000;
                    break;
                }
            }

            $detail->employer_contribution = round(($start * $er_rate + $er_add),1);
            $detail->employee_contribution = round($start * $ee_rate,1);
            $detail->total_sss = $detail->employer_contribution + $detail->employee_contribution;
            if(!$detail->sss_included){
                $detail->employer_contribution = 0;
                $detail->employee_contribution = 0;
                $detail->total_sss = 0;
            }
        }

        return datatables()->of($employee_details)->make(true);
    }

    public function pagibig(Request $request){
        $employee_details = EmployeeDetail::join('user_details','user_details.information_id','=','employee_details.information_id')
        ->get();

    foreach ($employee_details as $key => $employee) {
        $employee->attendance = $employee->FilteredAttendance($employee->employee_id, $request->from_date,$request->to_date);
    }

    foreach ($employee_details as $key => $detail) {
        // Computation for total hours
        $detail->complete_hours = 0;
        //Gross pay computation
        $detail->gross_pay = 0;
        //Computes total time and gross pay with overtime and multipay
        foreach ($detail->attendance as $key => $attendance) {
            $overtime = Overtime::where('attendance_id',$attendance->attendance_id)->first();
            $sched = EmployeeDetail::where('employee_id',$attendance->employee_id)->first();
            $multipay = MultiPay::where('attendance_id',$attendance->attendance_id)->first();

            $timein = $this->timeCalculator($attendance->time_in);
            $timeout = $this->timeCalculator($attendance->time_out);

            $stimein = $this->timeCalculator($sched->schedule_Timein);
            $stimeout = $this->timeCalculator($sched->schedule_Timeout);
            $rate = $sched->rate;

            if($multipay){
                $rate = $rate * $multipay->status;
            }

            if($overtime){
                $time = ($timeout - $timein) / 3600;

                $detail->gross_pay += $rate * $time;
                $detail->complete_hours += round($time,2);
            }else{
                $time = ($stimeout - $stimein) / 3600;

                $detail->gross_pay += $rate * $time;
                $detail->complete_hours += round($time,2);
            }

            $detail->gross_pay = round($detail->gross_pay,2);

            $detail->complete_hours = round($detail->complete_hours,2);
        }

        $pagibig = Pagibig::first();

        $detail->employee_pagibig_contribution = 0;
        $detail->employer_pagibig_contribution = 0;

        if($detail->gross_pay < $pagibig->divider){
            $detail->employee_pagibig_contribution = $detail->gross_pay * ($pagibig->ee_min_rate / 100);
            $detail->employer_pagibig_contribution = $detail->gross_pay * ($pagibig->er_rate / 100);
        }
        if($detail->gross_pay > $pagibig->divider){
            if($detail->gross_pay * ($pagibig->ee_max_rate / 100) > $pagibig->maximum){
                $detail->employee_pagibig_contribution = $pagibig->maximum;
                $detail->employer_pagibig_contribution = $pagibig->maximum;
            }else{
                $detail->employee_pagibig_contribution = $detail->gross_pay * ($pagibig->ee_max_rate / 100);
                $detail->employer_pagibig_contribution = $detail->gross_pay * ($pagibig->er_rate / 100);

                if($detail->employer_pagibig_contribution > $pagibig->maximum){
                    $temp = $detail->employer_pagibig_contribution - $pagibig->maximum;
                    $detail->employer_pagibig_contribution -= $temp;
                    $detail->employee_pagibig_contribution += $temp;
                }

                if($detail->employee_pagibig_contribution > $pagibig->maximum){
                    $temp = $detail->employee_pagibig_contribution -= $pagibig->maximum;
                    $detail->employee_pagibig_contribution -= $temp;
                    $detail->employer_pagibig_contribution += $temp;
                }
            }
        }

        $detail->employee_pagibig_contribution = round($detail->employee_pagibig_contribution,2);
        $detail->employer_pagibig_contribution = round($detail->employer_pagibig_contribution,2);
        $detail->total_pagibig_contribution = round($detail->employee_pagibig_contribution + $detail->employer_pagibig_contribution,2);
    }

    return datatables()->of($employee_details)->make(true);
    }

    public function philhealth(Request $request){
        $employee_details = EmployeeDetail::join('user_details','user_details.information_id','=','employee_details.information_id')
        ->get();

        $date = Carbon::parse($request->from_date);
        $diff = $date->diffInDays($request->to_date) + 1;


    foreach ($employee_details as $key => $employee) {
        $employee->attendance = $employee->FilteredAttendance($employee->employee_id, $request->from_date,$request->to_date);
    }

    foreach ($employee_details as $key => $detail) {
        // Computation for total hours
        $detail->complete_hours = 0;
        //Gross pay computation
        $detail->gross_pay = 0;
        //Computes total time and gross pay with overtime and multipay
        foreach ($detail->attendance as $key => $attendance) {
            $overtime = Overtime::where('attendance_id',$attendance->attendance_id)->first();
            $sched = EmployeeDetail::where('employee_id',$attendance->employee_id)->first();
            $multipay = MultiPay::where('attendance_id',$attendance->attendance_id)->first();

            $timein = $this->timeCalculator($attendance->time_in);
            $timeout = $this->timeCalculator($attendance->time_out);

            $stimein = $this->timeCalculator($sched->schedule_Timein);
            $stimeout = $this->timeCalculator($sched->schedule_Timeout);
            $rate = $sched->rate;

            if($multipay){
                $rate = $rate * $multipay->status;
            }

            if($overtime){
                $time = ($timeout - $timein) / 3600;

                $detail->gross_pay += $rate * $time;
                $detail->complete_hours += round($time,2);
            }else{
                $time = ($stimeout - $stimein) / 3600;

                $detail->gross_pay += $rate * $time;
                $detail->complete_hours += round($time,2);
            }

            $detail->gross_pay = round($detail->gross_pay,2);

            $detail->complete_hours = round($detail->complete_hours,2);
        }

        $philhealth = philhealth::first();

        $detail->employer_philhealth_contribution = 0;
        $detail->employee_philhealth_contribution = 0;

        if($detail->gross_pay < $philhealth->minimum){
            $total_philhealth_payment = $philhealth->minimum_contribution;
            $detail->employer_philhealth_contribution +=  ($total_philhealth_payment * ($philhealth->er_rate / 100)) * ($diff / 30);
            $detail->employee_philhealth_contribution +=  ($total_philhealth_payment * ($philhealth->ee_rate / 100)) * ($diff / 30);
        }
        elseif($detail->gross_pay > $philhealth->maximum){
            $total_philhealth_payment = $philhealth->ph_cap;
            $detail->employer_philhealth_contribution = ($total_philhealth_payment * ($philhealth->er_rate / 100)) * ($diff / 30);
            $detail->employee_philhealth_contribution = ($total_philhealth_payment * ($philhealth->ee_rate / 100)) * ($diff / 30);
        }else{
            $total_philhealth_payment = $detail->gross_pay * ($philhealth->ph_rate/100);
            $detail->employer_philhealth_contribution = ($total_philhealth_payment * ($philhealth->er_rate / 100) * ($diff / 30));
            $detail->employee_philhealth_contribution = ($total_philhealth_payment * ($philhealth->ee_rate / 100) * ($diff / 30));
        }

        $detail->employer_philhealth_contribution = round($detail->employer_philhealth_contribution,2);
        $detail->employee_philhealth_contribution = round($detail->employee_philhealth_contribution,2);

        $detail->total_philhealth_contribution = round($detail->employer_philhealth_contribution + $detail->employee_philhealth_contribution,2);

        if(!$detail->philhealth_included){
            $detail->employer_philhealth_contribution = 0;
            $detail->employee_philhealth_contribution = 0;
            $detail->total_philhealth_contribution = 0;
        }
    }

    return datatables()->of($employee_details)->make(true);
    }

/*=============================================================================
|                                   END
*==============================================================================*/




/*=============================================================================
|                                 START
|                           Notification JSON
|
*==============================================================================*/

    public function Notification(){
        $applicant = ApplicantDetail::with('UserDetail')->get();
        $employee = EmployeeDetail::with('UserDetail')->get();

        $arr = [];

        foreach ($applicant as $key => $value) {
            array_push($arr, $value);
        }

        foreach ($employee as $key => $value) {
            array_push($arr, $value);
        }

        return datatables()->of($arr)->make(true);
    }

/*=============================================================================
|                                   END
*==============================================================================*/

/*=============================================================================
|                                 START
|                              Holiday JSON
|
*==============================================================================*/

    public function holidayJson(Request $request){
        $holiday_table = Holiday::whereBetween('holidays.holiday_start_date',[$request->from_date,new DateTime($request->to_date ." ". "23:59")])
            ->get();

        return datatables()->of($holiday_table)
            ->addColumn('delete',function($data){
            $button = ' <form action="/removeHoliday/'. $data->holiday_id .'" onsubmit="return confirm(\'Do you really want to delete holiday #'. $data->holiday_id .'?\');" method="GET">
                        <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="h2 bi bi-trash"></i><br>Remove</button>
                        </form>';
            return $button;
            })
            ->rawColumns(['delete'])
            ->make(true);
    }

    public function holidayAllAttendanceJson(Request $request){
        $data = Holiday::with('attendance')
            ->whereBetween('holidays.holiday_start_date',[$request->from_date,new DateTime($request->to_date ." ". "23:59")])
            ->has('attendance', '>', 0)
            ->get();

        return datatables()->of($data)
        ->addColumn('att_count',function($data){
            return count($data->attendance);
        })
        ->addColumn('delete',function($data){
            $button = ' <form action="/removeHolidayAllAttendance/'. $data->holiday_id .'" onsubmit="return confirm(\'Do you really want to delete all attendance on holiday #'. $data->holiday_id .'?\');" method="GET">
                        <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="h2 bi bi-trash"></i><br>Remove</button>
                        </form>';
            return $button;
        })
        ->addColumn('payroll_manager',function($data){
            $att = holiday_attendance::where('holiday_id',$data->holiday_id)->first();
            $pr_manager = UserDetail::where('login_id',$att->payrollManager_id)->first();
            return "$pr_manager->fname $pr_manager->mname $pr_manager->lname";
        })
        ->addColumn('added_on',function($data){
            $att = holiday_attendance::where('holiday_id',$data->holiday_id)->first();
            return date_format($att->created_at,"Y/m/d H:i:s");
        })
        ->rawColumns(['att_count','delete','payroll_manager','added_on'])
        ->make(true);
    }

    public function holidayJsonAttendance(Request $request){
        $hol_attendance = holiday_attendance::join('holidays','holidays.holiday_id','=','holiday_attendances.holiday_id')
            ->join('attendances','attendances.attendance_id','=','holiday_attendances.attendance_id')
            ->join('employee_details','employee_details.employee_id','=','attendances.employee_id')
            ->join('user_details','user_details.information_id','=','employee_details.information_id')
            ->whereBetween('attendances.attendance_date',[$request->from_date,new DateTime($request->to_date ." ". "23:59")])
            ->get();

        return datatables()->of($hol_attendance)
        ->addColumn('employee_details',function($data){
            $detail = '<h5>'. $data->fname . ' ' . $data->mname . ' '. $data->lname .'</h5>
                    '. $data->department. '<br>
                    '.$data->position;
            return $detail;
        })
        ->addColumn('delete',function($data){
            $button = ' <form action="/removeHolidayAttendance/'. $data->id .'/'. $data->attendance_id .'" onsubmit="return confirm(\'Do you really want to delete holiday attendance #'. $data->attendance_id .'?\');" method="GET">
                        <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="h2 bi bi-trash"></i><br>Remove</button>
                        </form>';
            return $button;
        })
        ->addColumn('payroll_manager',function($data){
            $pr_manager = UserDetail::where('login_id',$data->payrollManager_id)->first();
            return "$pr_manager->fname $pr_manager->mname $pr_manager->lname";
        })
        ->addColumn('added_on',function($data){
            return date_format($data->created_at,"Y/m/d H:i:s");
        })
        ->rawColumns(['employee_details','delete'])
        ->make(true);
    }

/*=============================================================================
|                                   END
*==============================================================================*/




/*=============================================================================
|                                 START
|                               Leave JSON
|
*==============================================================================*/

    public function leaveJson(Request $request){
        $leave = Leave::join('employee_details','employee_details.employee_id','=','leaves.employee_id')
            ->join('attendances','attendances.attendance_id','=','leaves.attendance_id')
            ->join('user_details','user_details.information_id','=','employee_details.information_id')
            ->whereBetween('attendances.attendance_date',[$request->from_date,new DateTime($request->to_date ." ". "23:59")])
            ->get();

        return datatables()->of($leave)
        ->addColumn('employee_details',function($data){
            $detail = '<h5>'. $data->fname . ' ' . $data->mname . ' '. $data->lname .'</h5>
                    '. $data->department. '<br>
                    '.$data->position;
            return $detail;
            })
            ->addColumn('delete',function($data){
                $button = ' <form action="/removeLeave/'. $data->id .'/'. $data->attendance_id .'" onsubmit="return confirm(\'Do you really want to delete leave #'. $data->id .'?\');" method="GET">
                            <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="h2 bi bi-trash"></i><br>Remove</button>
                            </form>';
                return $button;
            })
            ->addColumn('payroll_manager',function($data){
                $pr_manager = UserDetail::where('login_id',$data->payrollManager_id)->first();
                return "$pr_manager->fname $pr_manager->mname $pr_manager->lname";
            })
            ->addColumn('added_on',function($data){
                return date_format($data->created_at,"Y/m/d H:i:s");
            })
            ->rawColumns(['employee_details','delete'])
            ->make(true);
    }

/*=============================================================================
|                                   END
*==============================================================================*/


/*=============================================================================
|                                 START
|                            13th Month JSON
|
*==============================================================================*/

public function thirteenthMonthJSON(Request $request){
    $employees = EmployeeDetail::join('user_details','user_details.information_id','=','employee_details.information_id')
        ->get();

    foreach ($employees as $key => $employee) {
        $employee->payroll = '';
        $employee->payroll = $employee->FilteredPayroll($employee->employee_id, $request->from_date,$request->to_date);
    }

    return datatables()->of($employees)
        ->addColumn('employee_details',function($data){
            try {
                $detail = '<h5>'. $data->fname . ' ' . $data->mname . ' '. $data->lname .'</h5>
                    '. $data->department. '<br>
                    '.$data->position;

                return $detail;
            } catch (\Throwable $th) {
                return '';
            }
        })
        ->addColumn('net_sum',function($data){
            try {
                $detail = 0;
                foreach ($data->payroll as $key => $value) {
                    $detail += $value->net_pay;
                }
                return round($detail,2  );
            } catch (\Throwable $th) {
                return '';
            }
        })
        ->addColumn('bonus',function($data){
            try {
                $detail = 0;
                foreach ($data->payroll as $key => $value) {
                    $detail += $value->net_pay;
                }
                return round($detail / 12,2);
            } catch (\Throwable $th) {
                return '';
            }
        })
        ->addColumn('dates',function($data){
            try {
                $detail = '';
                $detail .= $data->payroll[0]->payroll_date;
                $detail .= ' - ';
                $detail .= $data->payroll[count($data->payroll)-1]->payroll_date;
                return $detail;
            } catch (\Throwable $th) {
                return '';
            }
        })
        ->addColumn('total_months',function($data){
            try {
                $date1 = new DateTime($data->payroll[0]->payroll_date);

                $date2 = date_create($data->payroll[count($data->payroll)-1]->payroll_date);
                date_add($date2,date_interval_create_from_date_string("15 days"));

                $interval = $date1->diff($date2);

                return  $interval->m." mos, ".$interval->d." days ";
            } catch (\Throwable $th) {
                return '';
            }
        })
        ->rawColumns(['net_sum','employee_details','bonus','dates','total_months'])
        ->make(true);
}

function Audit(Request $request){
    $audit = Audit::with('payroll_manager')
    ->whereBetween('created_at',[$request->from_date,new DateTime($request->to_date ." ". "23:59")])
    ->where('activity_type','payroll')
        ->get();

    return datatables()->of($audit)
    ->addColumn('date',function($data){
        $date = date($data->created_at);

        return $date;
    })
    ->addColumn('payroll',function($data){
        $payroll = '<h5>'. $data->payroll_manager->fname . ' ' . $data->payroll_manager->mname . ' '. $data->payroll_manager->lname .'</h5>';

        return $payroll;
    })
    ->addColumn('employee_detail',function($data){
        if(isset($data->employee)){
            $payroll = '<h5>'. $data->employee .'</h5>';

            return $payroll;
        }
        else{
            return ' - ';
        }
    })
    ->rawColumns(['payroll','employee_detail','date'])
    ->make(true);
}
/*=============================================================================
|                                   END
*==============================================================================*/



    public function timeCalculator($time){
        list($hours, $minutes, $seconds) = explode(':',$time);
        return (($hours * 3600) + ($minutes * 60) + $seconds) - 3600 * 8;
    }

    function dateDiff($d1, $d2) {
        // Return the number of days between the two dates:
        return round(abs(strtotime($d1) - strtotime($d2))/86400);

    }
}
