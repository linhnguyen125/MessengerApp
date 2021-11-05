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
        $rooms = Auth::user()->chatRooms;
        $rooms[] = ChatRoom::find(1);
        $data = ['user' => Auth::user(), 'rooms' => $rooms, 'emojis' => Emoji::all()];
        return view('app', ['data' => $data]);
    }
}
