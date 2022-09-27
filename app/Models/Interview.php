<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;
    public $keyType = 'string';

    protected $fillable = ['applicant_id','interview_detail','interview_schedule','response_status','score','feedback'];
}
