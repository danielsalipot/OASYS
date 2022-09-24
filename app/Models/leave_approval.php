<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leave_approval extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'approver_id','approval_date','start_date','end_date','status','title','detail'];
}