<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;
    public $keyType = 'integer';
    public $primaryKey  = 'bonus_id';

    protected $fillable = ['payrollManager_id','employee_id','bonus_date','bonus_amount'];
}
