<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\UserDetail;

use App\Models\Attendance;
use App\Models\Deduction;
use App\Models\CashAdvance;
use App\Models\Taxes;
use App\Models\Bonus;
use App\Models\Payslips;

class EmployeeDetail extends Model
{
    use HasFactory;
    protected $fillable = ['login_id','information_id','educ','position','department','employment_status','resume','rate','start_date','schedule_Timein','schedule_Timeout'];

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

    public function FilteredPayroll($id,$start_date,$end_date){
        return Payslips::where('employee_id',$id)
            ->whereBetween('payroll_date',array($start_date,$end_date))
            ->orderBy('payroll_date','ASC')
            ->get();
    }


    public function FilteredAttendance($id,$start_date,$end_date) {
        return Attendance::where('employee_id',$id)
            ->whereBetween('attendance_date',array($start_date,$end_date))
            ->orderBy('attendance_date','ASC')
            ->get();
    }

    public function FilteredDeductions($id,$start_date,$end_date) {
        return Deduction::where('employee_id',$id)
            ->where('deduction_start_date','<=',$start_date)
            ->where('deduction_end_date','>=',$end_date)
            ->orderBy('deduction_start_date','ASC')
            ->get();
    }

    public function FilteredCashAdvance($id,$start_date,$end_date) {
        return CashAdvance::where('employee_id',$id)
        ->whereBetween('cash_advance_date',array($start_date,$end_date))
        ->orderBy('cash_advance_date','ASC')
        ->get();
    }

    public function FilteredBonus($id,$start_date,$end_date) {
        return Bonus::where('employee_id',$id)
        ->whereBetween('bonus_date',array($start_date,$end_date))
        ->orderBy('bonus_date','ASC')
        ->get();
    }
}
