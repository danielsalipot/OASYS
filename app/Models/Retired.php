<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retired extends Model
{
    use HasFactory;
    protected $keyType = 'string';

    protected $fillable = ['employee_id'];
}
