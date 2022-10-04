<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Overtime extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $primaryKey  = 'overtime_id';
    protected $keyType = 'string';


    protected $fillable = ['employee_id','attendance_id','payrollManager_id'];

}
