<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\EmployeeDetail;
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

        return back();
    }

    public function EmployeePositionUpdate(Request $request){
        $ids = explode(';',$request->hidden_emp_id);

        for ($i=0; $i < count($ids)-1; $i++) {
            EmployeeDetail::where('employee_id',$ids[$i])
                ->update([
                    'position' => $request->position_title
                ]);
        }

        return back();
    }
}
