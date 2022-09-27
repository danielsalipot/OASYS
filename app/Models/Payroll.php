<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $keyType = 'string';

    protected $fillable = ['filename','payroll_manager_id','from_date','to_date','height_reference'];
}
