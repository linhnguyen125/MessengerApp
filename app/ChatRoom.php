<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    protected $fillable = ['name', 'description', 'thumbnail', 'created_by'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
