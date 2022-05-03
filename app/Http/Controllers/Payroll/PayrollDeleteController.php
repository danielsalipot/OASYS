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

class PayrollDeleteController extends Controller
{
    public function DeleteOvertime(Request $request){
        $ids = explode(';',$request->overtime_id);

        for ($i=0; $i < count($ids) - 1; $i++) {
            Overtime::where('overtime_id',$ids[$i])->delete();
        }

        return redirect('/payroll/overtime');
    }

    public function DeleteDeduction($id){
        Deduction::where('deduction_id',$id)->delete();
        return redirect('/payroll/deduction');
    }

    public function DeleteCashAdvance($id){
        CashAdvance::where('cashAdvances_id',$id)->delete();
        return redirect('/payroll/cashadvance');
    }

    public function DeleteBonus($id){
        Bonus::where('bonus_id',$id)->delete();
        return redirect('/payroll/bonus');
    }

    public function DeleteMultiPay($id){
        MultiPay::where('multi_pay_id',$id)->delete();
        return redirect('/payroll/doublepay');
    }

    public function DeleteHoliday($id){
        Holiday::where('holiday_id',$id)->delete();
        return redirect('/payroll/holidays');
    }

    public function DeleteHolidayAttendance($hid,$aid){
        holiday_attendance::where('id',$hid)->delete();
        Attendance::where('attendance_id',$aid)->delete();
        return redirect('/payroll/holidays');
    }

    public function DeleteLeave($lid,$aid){
        Leave::where('id',$lid)->delete();
        Attendance::where('attendance_id',$aid)->delete();
        return redirect('/payroll/leave');
    }
}
