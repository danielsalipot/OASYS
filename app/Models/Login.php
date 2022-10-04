<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Login extends Model
{

    use SoftDeletes;
    protected $table = 'login_tbl';
    use HasFactory;

    protected $keyType = 'string';

}
