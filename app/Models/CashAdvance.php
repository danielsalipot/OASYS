<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashAdvance extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $primaryKey  = 'cashAdvances_id';
    protected $keyType = 'string';


    protected $fillable = ['payrollManager_id','employee_id','cash_advance_date','cashAdvance_amount'];
}
