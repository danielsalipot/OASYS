<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    public $keyType = 'bigint';
public $primaryKey = 'attendance_id';

    protected $fillable = ['employee_id','time_in','time_out','attendance_day','attendance_date'];
}
