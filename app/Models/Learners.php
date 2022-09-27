<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Learners extends Model
{
    use HasFactory;
    protected $keyType = 'string';

    protected $fillable = ['module','video_id','employee_id','progress','start_date','end_date','completion_date','completion_status'];
}
