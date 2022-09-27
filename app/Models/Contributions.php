<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contributions extends Model
{
    use HasFactory;
    public $keyType = 'string';
    public $primaryKey  = 'contribution_id';

    protected $fillable = ['employee_contribution','employer_contribution','add_high','add_low','low_limit','high_limit'];
}
