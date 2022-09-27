<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\holiday_attendance;

class Holiday extends Model
{
    use HasFactory;
    public $keyType = 'integer';
    public $primaryKey  = 'holiday_id';

    protected $fillable = ['holiday_name','holiday_start_date','holiday_end_date'];

    public function Attendance(){
        return $this->hasMany(holiday_attendance::class, 'holiday_id', 'holiday_id');
    }
}
