<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payroll_approval extends Model
{
    use HasFactory;
    protected $keyType = 'string';

    protected $fillable = ['payroll_id','payroll_sign','status'];
}
