<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coe extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id','fname','mname','lname','email','username','path'];
}