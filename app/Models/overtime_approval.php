<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class overtime_approval extends Model
{
    use HasFactory;
    protected $keyType = 'string';

    protected $fillable = ['employee_id','attendance_id','overtime_date','message','approver_id','status'];
}
