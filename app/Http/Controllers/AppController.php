<?php

namespace App\Http\Controllers;

use App\ChatRoom;
use App\Emoji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function index()
    {
        $data = ['user' => Auth::user(), 'rooms' => ChatRoom::all(), 'emojis' => Emoji::all()];
        return view('app', ['data' => $data]);
    }
}
