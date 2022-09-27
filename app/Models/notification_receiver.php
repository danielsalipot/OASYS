<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\notification_message;

class notification_receiver extends Model
{
    use HasFactory;
    public $keyType = 'string';

    protected $fillable = ['receiver_id','notification_messages_id'];

    public function message(){
        return $this->hasOne(notification_message::class,'id', 'notification_messages_id');
    }
}
