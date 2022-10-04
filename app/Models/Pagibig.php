<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pagibig extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $keyType = 'string';
    protected $fillable = ['ee_rate','er_rate','ph_cap','ph_rate','minimum_contribution','minimum','maximum'];
}
