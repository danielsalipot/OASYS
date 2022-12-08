<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leave_cashout extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id','leave_days', 'total_cashout','approval_status', 'approver_id','approval_date'];
}
