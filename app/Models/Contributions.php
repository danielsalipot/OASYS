<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contributions extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $primaryKey  = 'contribution_id';
    protected $keyType = 'string';

    protected $fillable = ['employee_contribution','employer_contribution','add_high','add_low','low_limit','high_limit'];
}
