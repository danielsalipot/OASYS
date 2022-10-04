<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessment extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $keyType = 'string';
    protected $fillable = ['employee_id','assessment_type','score','feedback','year','quarter','start_date','end_date'];
}
