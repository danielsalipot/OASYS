<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $primaryKey  = 'message_id';
    protected $keyType = 'string';

    protected $fillable = ['sender_id','receiver_id','message'];
}
