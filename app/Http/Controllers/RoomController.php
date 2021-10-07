<?php

namespace App\Http\Controllers;

use App\ChatRoom;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = ChatRoom::all();
        return $rooms;
    }

    public function add(Request $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description
        ];
        $newRoom = ChatRoom::create($data);
        if ($newRoom) {
            return ['message' => "Tạo phòng thành công"];
        } else {
            return ['message' => "Tạo phòng thất bại"];
        }
    }

    public function show(Request $request){
        $room = ChatRoom::find($request->id);
        return $room;
    }

    public function update(Request $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description
        ];
        $newRoom = ChatRoom::where('id', $request->id)->update($data);
        if ($newRoom) {
            return ['message' => "Chỉnh sửa phòng thành công"];
        } else {
            return ['message' => "Chỉnh sửa phòng thất bại"];
        }
    }

    public function delete(Request $request){
        $room = ChatRoom::find($request->id);
        $status =  $room->delete();
        return $status;
    }
}
