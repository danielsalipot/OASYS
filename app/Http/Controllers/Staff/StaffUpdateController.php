<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\EmployeeDetail;
use App\Models\Interview;
use Illuminate\Http\Request;

class StaffUpdateController extends Controller
{
    public function EmployeeDepartmentUpdate(Request $request){
        $ids = explode(';',$request->hidden_emp_id);

        for ($i=0; $i < count($ids)-1; $i++) {
            EmployeeDetail::where('employee_id',$ids[$i])
                ->update([
                    'department' => $request->department_name
                ]);
        }

        return back()->with('success','The action was recorded successfully');
    }

    public function EmployeePositionUpdate(Request $request){
        $ids = explode(';',$request->hidden_emp_id);

        for ($i=0; $i < count($ids)-1; $i++) {
            EmployeeDetail::where('employee_id',$ids[$i])
                ->update([
                    'position' => $request->position_title
                ]);
        }

        return back()->with('success','The action was recorded successfully');
    }

    public function WithResponseInterview(Request $request){
        Interview::find($request->interview_id)->update([
            'response_status'=> 1,
            'score'=> $request->score,
            'feedback'=> $request->feedback
        ]);

        return back()->with('success','The action was recorded successfully');
    }

    public function NoResponseInterview(Request $request){
        Interview::find($request->interview_id)->update([
            'response_status'=> 0
        ]);

        return back()->with('success','The action was recorded successfully');
    }
}
