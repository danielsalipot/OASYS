<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslips extends Model
{
    use HasFactory;
    public $keyType = 'string';

    protected $fillable = ['employee_id','payroll_id','net_pay','payroll_date','file_name','file_path'];
}
