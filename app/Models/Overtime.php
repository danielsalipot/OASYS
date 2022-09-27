<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    use HasFactory;

    public $keyType = 'string';
    public $primaryKey  = 'overtime_id';

    protected $fillable = ['employee_id','attendance_id','payrollManager_id'];

}
