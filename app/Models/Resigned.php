<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resigned extends Model
{
    use HasFactory;
    protected $keyType = 'string';

    protected $fillable = ['employee_id','resignation_path','status','update_date','manager_id'];
}
