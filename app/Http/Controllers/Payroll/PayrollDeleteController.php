<?php

namespace App\Http\Controllers\payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Overtime;
use App\Models\Deduction;
use App\Models\CashAdvance;
use App\Models\Bonus;
use App\Models\MultiPay;

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
}
