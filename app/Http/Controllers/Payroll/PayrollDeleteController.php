<?php

namespace App\Http\Controllers\payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Overtime;
use App\Models\Deduction;
use App\Models\CashAdvance;
use App\Models\Bonus;
use App\Models\MultiPay;
use App\Models\Holiday;
use App\Models\Attendance;
use App\Models\holiday_attendance;
use App\Models\Leave;
use App\Models\payroll_audit;

class PayrollDeleteController extends Controller
{
    public function DeleteOvertime(Request $request){
        $ids = explode(';',$request->overtime_id);

        for ($i=0; $i < count($ids) - 1; $i++) {
            $att_id = Overtime::where('overtime_id',$ids[$i])->first();

            payroll_audit::create([
                'payroll_manager_id' => session()->get('user_id'),
                'type' => 'Overtime',
                'employee' => $att_id->employee_id,
                'activity' => 'Remove Overtime',
                'amount' => '-',
                'tid' => $ids[$i],
            ]);

            Overtime::where('overtime_id',$ids[$i])->delete();
        }

        return redirect('/payroll/overtime');
    }

    public function DeleteDeduction($id){
        $deduction = Deduction::where('deduction_id',$id)->first();
        payroll_audit::create([
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Deduction',
            'employee' => $deduction->employee_id,
            'activity' => 'Remove Deduction ('.$deduction->deduction_name.')',
            'amount' => $deduction->deduction_amount,
            'tid' => $deduction->deduction_id,
        ]);

        Deduction::where('deduction_id',$id)->delete();

        return redirect('/payroll/deduction');
    }

    public function DeleteCashAdvance($id){
        $ca = CashAdvance::where('cashAdvances_id',$id)->first();
        payroll_audit::create([
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Cash Advance',
            'employee' => $ca->employee_id,
            'activity' => 'Remove Cash Advance',
            'amount' => $ca->cashAdvance_amount,
            'tid' => $ca->cashAdvances_id,
        ]);

        CashAdvance::where('cashAdvances_id',$id)->delete();

        return redirect('/payroll/cashadvance');
    }

    public function DeleteBonus($id){
        $bonus = Bonus::where('bonus_id',$id)->first();
        payroll_audit::create([
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Bonus',
            'employee' => $bonus->employee_id,
            'activity' => 'Remove Bonus',
            'amount' => $bonus->bonus_amount,
            'tid' => $bonus->bonus_id,
        ]);

        Bonus::where('bonus_id',$id)->delete();

        return redirect('/payroll/bonus');
    }

    public function DeleteMultiPay($id){
        $multipay = MultiPay::where('multi_pay_id',$id)->first();

        payroll_audit::create([
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Multi Salary',
            'employee' => $multipay->employee_id,
            'activity' => 'Remove Multi Salary',
            'amount' => '-',
            'tid' => $multipay->multi_pay_id,x1
        ]);

        MultiPay::where('multi_pay_id',$id)->delete();
        return redirect('/payroll/doublepay');
    }

    public function DeleteHoliday($id){
        $holiday = Holiday::where('holiday_id',$id)->first();

        payroll_audit::create([
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Holiday',
            'employee' => ' - ',
            'activity' => 'Unlisted Holiday ('.$holiday->holiday_name.')',
            'amount' => '-',
            'tid' => $holiday->holiday_id,
        ]);

        Holiday::where('holiday_id',$id)->delete();
        return redirect('/payroll/holidays');
    }

    public function DeleteHolidayAllAttendance($id){
        $attendance = holiday_attendance::where('holiday_id',$id)->get();
        foreach ($attendance as $key => $value) {
            $att = Attendance::where('attendance_id',$value->attendance_id)->first();
            $ha_att = holiday_attendance::join('holidays','holidays.holiday_id','=','holiday_attendances.holiday_id')
                ->where('attendance_id',$value->attendance_id)
                ->first();

            payroll_audit::create([
                'payroll_manager_id' => session()->get('user_id'),
                'type' => 'Holiday Attendance',
                'employee' => $att->employee_id,
                'activity' => 'Unpaid holiday ('.$ha_att->holiday_name.')',
                'amount' => '-',
                'tid' => $ha_att->id,
            ]);

            Attendance::where('attendance_id',$value->attendance_id)->delete();
            holiday_attendance::where('attendance_id',$value->attendance_id)->delete();
        }

        return redirect('/payroll/holidays');
    }

    public function DeleteHolidayAttendance($hid,$aid){
        $ha_att = holiday_attendance::join('holidays','holidays.holiday_id','=','holiday_attendances.holiday_id')
            ->join('attendances','attendances.attendance_id','=','holiday_attendances.attendance_id')
            ->where('id',$hid)
            ->first();

        payroll_audit::create([
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Holiday Attendance',
            'employee' => $ha_att->employee_id,
            'activity' => 'Unpaid holiday ('.$ha_att->holiday_name.')',
            'amount' => '-',
            'tid' => $ha_att->id,
        ]);

        holiday_attendance::where('id',$hid)->delete();
        Attendance::where('attendance_id',$aid)->delete();

        return redirect('/payroll/holidays');
    }

    public function DeleteLeave($lid,$aid){
        $leave = Leave::where('id',$lid)->first();

        payroll_audit::create([
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Leave',
            'employee' => $leave->employee_id,
            'activity' => 'Remove Leave',
            'amount' => '-',
            'tid' => $leave->id,
        ]);
        Attendance::where('attendance_id',$aid)->delete();
        return redirect('/payroll/leave');
    }
}
