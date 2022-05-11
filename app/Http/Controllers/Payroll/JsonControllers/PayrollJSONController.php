<?php

namespace App\Http\Controllers\Payroll\JsonControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DateTime;
use DatePeriod;
use DateInterval;

use App\Models\EmployeeDetail;
use App\Models\UserDetail;
use App\Models\CashAdvance;
use App\Models\Attendance;
use App\Models\Deduction;
use App\Models\MultiPay;
use App\Models\Overtime;
use App\Models\Bonus;
use App\Models\Contributions;
use App\Models\Message;
use App\Models\ApplicantDetail;
use App\Models\Holiday;
use App\Models\holiday_attendance;
use App\Models\Leave;
use App\Models\Pagibig;
use App\Models\philhealth;
use App\Models\Payslips;
use App\Models\UserCredential;
use App\Models\payroll_audit;

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
            ->whereBetween('cash_advances.cash_advance_date',[$request->from_date,$request->to_date])
            ->get();

            return datatables()->of($cashAdvanceRecord)
                ->addColumn('delete',function($data){
                $button = ' <form action="/removeCashAdvance/'. $data->cashAdvances_id .'" method="GET">
                            <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="bi bi-trash"></i></button>
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
                \''. $data->userDetail->fname . ' ' . $data->userDetail->mname . ' ' . $data->userDetail->lname .'\',
                \''. $data->department .'\',
                \''. $data->position .'\',
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
            ->whereBetween('deductions.deduction_start_date',[$request->from_date,$request->to_date])
            ->get();

        return datatables()->of($deductions)
            ->addColumn('delete',function($data){
                $button = ' <form action="/removeDeduction/'.$data->deduction_id.'" method="GET">
                            <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="bi bi-trash"></i></button>
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
        $paid_overtime_arr =[];

        foreach ($employee_schedules as $key => $employee) {

                $stimeout = $this->timeCalculator($employee->schedule_Timeout);
                // Add 30 mins for minimum overtime
                $stimeout += $request->time_filter;

            $temp = Attendance::where('employee_id',$employee->employee_id)
                ->whereBetween('attendance_date',[$request->from_date,$request->to_date])
                ->whereBetween('time_in',['00:00:00',$employee->schedule_Timein])
                ->whereBetween('time_out',[date('H:i:s',$stimeout),'24:00:00'])
                ->get();

            foreach ($temp as $key => $value) {
                if(Overtime::where('attendance_id',$value->attendance_id)->first()){
                    array_push($paid_overtime_arr,$value);
                }else{
                    array_push($employee_overtime_arr,$value);
                }
            }
        }

        foreach ($employee_overtime_arr as $key => $employee) {
            $employee->user_details = EmployeeDetail::where('employee_id', $employee->employee_id)
                ->join('user_details','user_details.information_id','=','employee_details.information_id')
                ->first();

                $timeout = $this->timeCalculator($employee->time_out);
                $stimeout = $this->timeCalculator($employee->user_details->schedule_Timeout);

                $employee->total_overtime_hours = round(($timeout - $stimeout) / 3600,2);
        }

        return datatables()->of($employee_overtime_arr)->make(true);
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
            ->whereBetween('bonuses.bonus_date',[$request->from_date,$request->to_date])
            ->get();

        return datatables()->of($BonusRecords)
            ->addColumn('delete',function($data){
            $button = ' <form action="/removeDeleteBonus/'. $data->bonus_id .'" method="GET">
                        <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="bi bi-trash"></i></button>
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
            ->whereBetween('attendances.attendance_date',[$request->from_date,$request->to_date])
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
            ->whereBetween('attendances.attendance_date',[$request->from_date,$request->to_date])
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
            $button = ' <form action="/removeMultiPay/'. $data->multi_pay_id .'" method="GET">
                        <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="bi bi-trash"></i></button>
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
            if($gross_pay < 15000){$er_add = $sss_rate->add_low;}
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
            $detail->employee_pagibig_contribution = $detail->gross_pay * ($pagibig->ee_rate / 100);
            $detail->employer_pagibig_contribution = $detail->gross_pay * ($pagibig->er_rate / 100);
        }
        if($detail->gross_pay > $pagibig->divider){
            if($detail->gross_pay * ($pagibig->ee_rate / 100) > $pagibig->maximum){
                $detail->employee_pagibig_contribution = $pagibig->maximum;
                $detail->employer_pagibig_contribution = $pagibig->maximum;
            }else{
                $detail->employee_pagibig_contribution = $detail->gross_pay * ($pagibig->ee_rate / 100);
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
            $detail->employer_philhealth_contribution += 0;
            $detail->employee_philhealth_contribution += 137.50;
        }
        elseif($detail->gross_pay > $philhealth->maximum){
            $total_philhealth_payment = $philhealth->ph_cap;
            $detail->employer_philhealth_contribution = $total_philhealth_payment * ($philhealth->er_rate / 100);
            $detail->employee_philhealth_contribution = $total_philhealth_payment * ($philhealth->ee_rate / 100);
        }else{
            $total_philhealth_payment = $detail->gross_pay * ($philhealth->ph_rate/100);
            $detail->employer_philhealth_contribution = $total_philhealth_payment * ($philhealth->er_rate / 100);
            $detail->employee_philhealth_contribution = $total_philhealth_payment * ($philhealth->ee_rate / 100);
        }

        $detail->employer_philhealth_contribution = round($detail->employer_philhealth_contribution,2);
        $detail->employee_philhealth_contribution = round($detail->employee_philhealth_contribution,2);

        $detail->total_philhealth_contribution = round($detail->employer_philhealth_contribution + $detail->employee_philhealth_contribution,2);
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
|                             Messaging JSON
|
*==============================================================================*/

    public function Message($r_id){
        $send = Message::where(function ($query) use ($r_id) {
            $query->where('receiver_id',$r_id)
            ->where('sender_id',session('user_id'));
            })
            ->orWhere(function ($query) use ($r_id) {
                $query->where('sender_id',$r_id)
                ->where('receiver_id',session('user_id'));
                })
            ->orderBy('created_at','ASC')
            ->get();

        foreach ($send as $key => $value) {
            $value->sender = UserDetail::where('login_id',$value->sender_id)->first();
            $value->receiver = UserDetail::where('login_id',$value->receiver_id)->first();
        }

        return $send;
    }

    public function ChatEmployeeDetails(){
        //all pwera lang sa applicants

        $users = UserCredential::join('user_details','user_details.login_id','=','user_credentials.login_id')
            ->where('user_credentials.user_type','!=','applicant')
            ->where('user_credentials.login_id','!=',session('user_id'))
            ->get();

        foreach ($users as $key => $user) {
            $user->userDetail = UserDetail::where("login_id", $user->login_id)->first();
        }

        return datatables()->of($users)
            ->addColumn('full_name',function($data){
                return $data->userDetail->fname . " " . $data->userDetail->mname . " " . $data->userDetail->lname;
            })
            ->addColumn('btn',function($data){
                $full_name = $data->userDetail->fname . " " . $data->userDetail->mname . " " . $data->userDetail->lname;

                $button ='
                <button id="btn'.$data->information_id.'" onclick="chat_click(this,\''.str_replace("'", "\'",$full_name).'\',\'/'.$data->userDetail->picture.'\','.$data->information_id.')" class="text-dark card w-100 shadow-lg text-center p-3 m-2">
                    <div class="d-flex align-items-center">
                        <img src="/'.$data->userDetail->picture.'" class="rounded" width="50" height="50">
                            <h5 class="ms-2">'. $full_name .'</h5>
                    </div>
                </button>';
                return $button;
            })
            ->rawColumns(['full_name','btn'])
            ->make(true);
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
        $holiday_table = Holiday::whereBetween('holidays.holiday_start_date',[$request->from_date,$request->to_date])
            ->get();

        return datatables()->of($holiday_table)
            ->addColumn('delete',function($data){
            $button = ' <form action="/removeHoliday/'. $data->holiday_id .'" method="GET">
                        <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="bi bi-trash"></i></button>
                        </form>';
            return $button;
            })
            ->rawColumns(['delete'])
            ->make(true);
    }

    public function holidayAllAttendanceJson(Request $request){
        $data = Holiday::with('attendance')
            ->whereBetween('holidays.holiday_start_date',[$request->from_date,$request->to_date])
            ->has('attendance', '>', 0)
            ->get();

        return datatables()->of($data)
        ->addColumn('att_count',function($data){
            return count($data->attendance);
        })
        ->addColumn('delete',function($data){
            $button = ' <form action="/removeHolidayAllAttendance/'. $data->holiday_id .'" method="GET">
                        <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="bi bi-trash"></i></button>
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
            ->whereBetween('attendances.attendance_date',[$request->from_date,$request->to_date])
            ->get();

        return datatables()->of($hol_attendance)
        ->addColumn('employee_details',function($data){
            $detail = '<h5>'. $data->fname . ' ' . $data->mname . ' '. $data->lname .'</h5>
                    '. $data->department. '<br>
                    '.$data->position;
            return $detail;
        })
        ->addColumn('delete',function($data){
            $button = ' <form action="/removeHolidayAttendance/'. $data->id .'/'. $data->attendance_id .'" method="GET">
                        <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="bi bi-trash"></i></button>
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
            ->whereBetween('attendances.attendance_date',[$request->from_date,$request->to_date])
            ->get();

        return datatables()->of($leave)
        ->addColumn('employee_details',function($data){
            $detail = '<h5>'. $data->fname . ' ' . $data->mname . ' '. $data->lname .'</h5>
                    '. $data->department. '<br>
                    '.$data->position;
            return $detail;
            })
            ->addColumn('delete',function($data){
                $button = ' <form action="/removeLeave/'. $data->id .'/'. $data->attendance_id .'" method="GET">
                            <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="bi bi-trash"></i></button>
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
            $detail = '<h5>'. $data->fname . ' ' . $data->mname . ' '. $data->lname .'</h5>
                '. $data->department. '<br>
                '.$data->position;

            return $detail;
        })
        ->addColumn('net_sum',function($data){
            $detail = 0;
            foreach ($data->payroll as $key => $value) {
                $detail += $value->net_pay;
            }
            return round($detail,2  );
        })
        ->addColumn('bonus',function($data){
            $detail = 0;
            foreach ($data->payroll as $key => $value) {
                $detail += $value->net_pay;
            }
            return round($detail / 12,2);
        })
        ->addColumn('dates',function($data){
            $detail = '';
            $detail .= $data->payroll[0]->payroll_date;
            $detail .= ' - ';
            $detail .= $data->payroll[count($data->payroll)-1]->payroll_date;
            return $detail;
        })
        ->addColumn('total_months',function($data){
            $date1 = new DateTime($data->payroll[0]->payroll_date);

            $date2 = date_create($data->payroll[count($data->payroll)-1]->payroll_date);
            date_add($date2,date_interval_create_from_date_string("15 days"));

            $interval = $date1->diff($date2);

            return  $interval->m." mos, ".$interval->d." days ";
        })
        ->rawColumns(['net_sum','employee_details','bonus','dates','total_months'])
        ->make(true);
}

/*=============================================================================
|                                   END
*==============================================================================*/

    public function timeCalculator($time){
        list($hours, $minutes, $seconds) = explode(':',$time);
        return $hours * 3600 + $minutes * 60 + $seconds;
    }

    function dateDiff($d1, $d2) {

        // Return the number of days between the two dates:
        return round(abs(strtotime($d1) - strtotime($d2))/86400);

    }

    function payroll_audit(Request $request){
        $audit = payroll_audit::with('payroll_manager','employee_detail')
        ->whereBetween('created_at',[$request->from_date,$request->to_date])
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
            if(isset($data->employee_detail)){
                $payroll = '<h5>'. $data->employee_detail->fname . ' ' . $data->employee_detail->mname . ' '. $data->employee_detail->lname .'</h5>';

                return $payroll;
            }
            else{
                return ' - ';
            }
        })
        ->rawColumns(['payroll','employee_detail','date'])
        ->make(true);
    }
}
