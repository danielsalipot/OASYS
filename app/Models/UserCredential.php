<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCredential extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $primaryKey  = 'login_id';
    protected $keyType = 'string';

    protected $fillable = ['username','password','user_type'];
}
