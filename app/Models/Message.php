<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    public $keyType = 'integer';
public $primaryKey  = 'message_id';

    protected $fillable = ['sender_id','receiver_id','message'];
}
