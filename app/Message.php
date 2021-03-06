<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['room', 'sender', 'receiver', 'content'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver');
    }

    public function room()
    {
        return $this->belongsTo(ChatRoom::class, 'room');
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class, 'msg_id');
    }
}
