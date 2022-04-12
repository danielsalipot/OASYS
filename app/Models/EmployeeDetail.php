<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\UserDetail;
use App\Models\Attendance;
use App\Models\Deduction;
use App\Models\CashAdvance;
use App\Models\Taxes;

class EmployeeDetail extends Model
{
    use HasFactory;
    protected $fillable = ['login_id','information_id','educ','position','department','employment_status','resume'];

    public function UserDetail(){
        return $this->hasOne(UserDetail::class,'information_id', 'information_id');
    }

    public function Attendance(){
        return $this->hasMany(Attendance::class, 'employee_id', 'employee_id');
    }

    public function Deduction(){
        return $this->hasMany(Deduction::class, 'employee_id', 'employee_id');
    }

    public function CashAdvance(){
        return $this->hasMany(CashAdvance::class, 'employee_id', 'employee_id');
    }

    public function Taxes(){
        return $this->hasOne(Taxes::class, 'employee_id', 'employee_id');
    }

    public function FilteredAttendance($id,$start_date,$end_date) {
        return Attendance::where('employee_id',$id)->whereBetween('attendance_date',array($start_date,$end_date))->get();
    }

    public function FilteredDeductions($id,$start_date,$end_date) {
        return Deductions::where('employee_id',$id)->whereBetween('deduction_date',array($start_date,$end_date))->get();
    }

    public function FilteredCashAdvance($id,$start_date,$end_date) {
        return CashAdvance::where('employee_id',$id)->whereBetween('cash_advance_date',array($start_date,$end_date))->get();
    }
}
