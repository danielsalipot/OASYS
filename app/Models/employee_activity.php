<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class employee_activity extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $keyType = 'string';

    protected $fillable = ['employee_id','description','activity_date'];

    public function EmployeeDetail(){
        return $this->hasOne(EmployeeDetail::class,'employee_id', 'employee_id');
    }

}
