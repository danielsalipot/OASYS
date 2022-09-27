<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;
    protected $keyType = 'string';

    protected $fillable = ['payroll_manager_id','activity_type','type','activity','amount','tid','employee'];

    public function payroll_manager(){
        return $this->hasOne(UserDetail::class,'information_id', 'payroll_manager_id');
    }

    public function employee_detail(){
        return $this->HasOne(UserDetail::class,'information_id', 'employee');
    }
}
