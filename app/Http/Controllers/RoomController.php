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
            'description' => $request->description,
        ];

        if ($request->get('thumbnail')) {
            $image = $request->get('thumbnail');
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->get('thumbnail'))->save(public_path('images/chat/') . $name);
            $data['thumbnail'] = env('APP_URL') . 'images/chat/' . $name;
        } 

        $newRoom = ChatRoom::create($data);
        if ($newRoom) {
            return ['message' => "Tạo phòng thành công"];
        } else {
            return ['message' => "Tạo phòng thất bại"];
        }
    }

    public function show(Request $request)
    {
        $room = ChatRoom::find($request->id);
        return $room;
    }

    public function update(Request $request)
    {
        $room = ChatRoom::find($request->id);
        if ($room->thumbnail === $request->thumbnail) {
            $thumbnail = $request->thumbnail;
        } else {
            if ($request->get('thumbnail')) {
                $image = $request->get('thumbnail');
                $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                \Image::make($request->get('thumbnail'))->save(public_path('images/chat/') . $name);
                //delete old image
                $arrayImage = explode('/', $room->thumbnail);
                $oldImage = end($arrayImage);
                if ($oldImage !== 'default.jpg') {
                    unlink(public_path('images/chat/') . $oldImage);
                }
                //create new image
                $thumbnail = env('APP_URL') . 'images/chat/' . $name;
            }
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail' => $thumbnail
        ];

        $newRoom = ChatRoom::where('id', $request->id)->update($data);
        if ($newRoom) {
            return ['message' => "Chỉnh sửa phòng thành công"];
        } else {
            return ['message' => "Chỉnh sửa phòng thất bại"];
        }
    }

    public function delete(Request $request)
    {
        $room = ChatRoom::find($request->id);
        //delete old image
        $arrayImage = explode('/', $room->thumbnail);
        $oldImage = end($arrayImage);
        if ($oldImage !== 'default.jpg') {
            unlink(public_path('images/chat/') . $oldImage);
        }
        $status =  $room->delete();
        return $status;
    }
}
