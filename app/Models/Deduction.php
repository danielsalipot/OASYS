<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;
    public $primaryKey  = 'deduction_id';
    public $keyType = 'string';


    protected $fillable = ['payrollManager_id','employee_id','deduction_name','deduction_start_date','deduction_end_date','deduction_amount'];
}
