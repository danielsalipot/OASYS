<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    public $primaryKey  = 'message_id';
    protected $keyType = 'string';

    protected $fillable = ['sender_id','receiver_id','message'];
}
