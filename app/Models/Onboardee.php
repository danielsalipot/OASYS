<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onboardee extends Model
{
    use HasFactory;
    public $keyType = 'string';

    protected $fillable = ['employee_id'];
}
