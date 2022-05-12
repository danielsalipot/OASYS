<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class StaffInsertController extends Controller
{
    public function InsertDepartment(Request $request){
        Department::create([
            'department_name'=> $request->dept_name
        ]);

        return back();
    }

    public function InsertPosition(Request $request){
        Position::create([
            'position_title'=> $request->pos_title,
            'position_description'=> $request->pos_desc
        ]);

        return back();
    }
}
