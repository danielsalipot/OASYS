<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class holiday_attendance extends Model
{
    use HasFactory;
    protected $keyType = 'string';

    protected $fillable = ['holiday_id','attendance_id','payrollManager_id'];
}
