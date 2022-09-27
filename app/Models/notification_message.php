<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\notification_receiver;

class notification_message extends Model
{
    use HasFactory;
    public $keyType = 'string';

    protected $fillable = ['sender_id','title','message'];

    public function receivers()
    {
        return $this->hasMany(notification_receiver::class,'notification_messages_id',);
    }
}
