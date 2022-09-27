<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification_acknowledgements extends Model
{
    use HasFactory;
    protected $keyType = 'string';

    protected $fillable = ['notification_receiver_id'];
}
