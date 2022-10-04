<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $primaryKey  = 'attendance_id';
    protected $keyType = 'string';


    protected $fillable = ['employee_id','time_in','time_out','attendance_day','attendance_date'];
}
