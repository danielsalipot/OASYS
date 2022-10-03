<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagibig extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    protected $fillable = ['ee_rate','er_rate','ph_cap','ph_rate','minimum_contribution','minimum','maximum'];
}
