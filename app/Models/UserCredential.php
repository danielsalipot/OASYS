<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCredential extends Model
{
    use HasFactory;
    public $keyType = 'bigint';
public $primaryKey = 'login_id';
    protected $fillable = ['username','password','user_type'];
}
