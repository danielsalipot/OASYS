<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\UserCredential;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = ['login_id','fname', 'mname','lname','sex','age','bday','cnum','email','picture'];

    // User Details With their respective login Credential
    public function UserCredential()
    {
        return $this->hasOne(UserCredential::class,'login_id', 'login_id');
    }
}
