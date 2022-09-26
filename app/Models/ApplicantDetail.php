<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantDetail extends Model
{
    use HasFactory;
    protected $fillable = ['login_id','information_id','educ','Applyingfor','resume'];
    public $keyType = 'integer';
public $primaryKey  = 'applicant_id';

    public function UserDetail(){
        return $this->hasOne(UserDetail::class,'information_id', 'information_id');
    }
}
