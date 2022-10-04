<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bonus extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $primaryKey  = 'bonus_id';
    protected $keyType = 'string';


    protected $fillable = ['payrollManager_id','employee_id','bonus_date','bonus_amount'];
}
