<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserChatRoom extends Model
{
    protected $table = 'chat_room_user';

    protected $fillable = ['id', 'user_id', 'chat_room_id'];
}
