<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiPay extends Model
{
    use HasFactory;
    protected $fillable = ['payrollManager_id','employee_id','attendance_id','status'];
}
