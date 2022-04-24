<?php

namespace App\Http\Controllers\payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Overtime;

class PayrollDeleteController extends Controller
{
    public function DeleteOvertime(Request $request){
        $ids = explode(';',$request->overtime_id);

        for ($i=0; $i < count($ids) - 1; $i++) {
            Overtime::where('overtime_id',$ids[$i])->delete();
        }

        return redirect('/payroll/overtime');
    }
}
