<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicantDetail extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['login_id','information_id','educ','Applyingfor','resume'];
    public $primaryKey  = 'applicant_id';
    protected $keyType = 'string';


    public function UserDetail(){
        return $this->hasOne(UserDetail::class,'information_id', 'information_id');
    }
}
