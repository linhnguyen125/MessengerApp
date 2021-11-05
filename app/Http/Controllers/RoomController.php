<?php

namespace App\Http\Controllers;

use App\ChatRoom;
use App\User;
use App\UserChatRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $rooms = $user->chatRooms;
        $rooms[] = ChatRoom::find(1);
        return $rooms;
    }

    public function listMemberById($id)
    {
        $room = ChatRoom::find($id);
        $users = $room->users;
        return $users;
    }

    public function add(Request $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => Auth::user()->id,
        ];

        $userChatRoomId = [];
        $members = [];
        $members = $request->members;


        if ($request->get('thumbnail')) {
            $image = $request->get('thumbnail');
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->get('thumbnail'))->save(public_path('images/chat/') . $name);
            $data['thumbnail'] = env('APP_URL') . 'images/chat/' . $name;
        }

        $newRoom = ChatRoom::create($data);
        $members[] = [
            'id' => Auth::user()->id,
            'chat_room_id'  => '1',
        ];
        if ($newRoom) {
            foreach ($members as $member) {
                $dataMember = [
                    'user_id' => $member['id'],
                    'chat_room_id'  => $newRoom->id,
                ];
                $userChatRoom = UserChatRoom::create($dataMember);
                if ($userChatRoom) {
                    $userChatRoomId[] = $userChatRoom->id;
                } else {
                    UserChatRoom::destroy($userChatRoomId);
                    $newRoom->delete();
                    return ['message' => "Có lỗi xảy ra, vui lòng thử lại sau"];
                    break;
                }
            }
        }
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
        if ($room->created_by == Auth::user()->id) {
            $status =  $room->delete();
        } else {
            return 'Bạn không phải là chủ phòng';
        }
        if ($oldImage !== 'default.jpg' && $status == '1') {
            unlink(public_path('images/chat/') . $oldImage);
        }
        return 'Xóa thành công';
    }

    public function listUserNotInRooms($id)
    {
        $userIdInRoom = UserChatRoom::where('chat_room_id', $id)->pluck('user_id');
        $userNotInRoom = User::select('id', 'name', 'email')->whereNotIn('id', $userIdInRoom)->get();
        return $userNotInRoom;
    }

    public function userCreated($id)
    {
        $room = ChatRoom::find($id);
        $userCreated = $room->created_by;
        return $userCreated;
    }

    public function deleteMember(Request $request)
    {
        $room = ChatRoom::find($request->roomId);
        $userCreated = $room->created_by;
        if (Auth::user()->id == $userCreated) {
            UserChatRoom::where([
                ['user_id', $request->id],
                ['chat_room_id', $request->roomId]
            ])->delete();
            return 'OK';
        } else {
            return ['error' => 'Bạn không phải là chủ phòng'];
        }
    }

    public function addMember(Request $request)
    {
        $userChatRoomId = [];
        $members = $request->members;
        if ($request->roomId != 1) {
            foreach ($members as $member) {
                $dataMember = [
                    'user_id' => $member['id'],
                    'chat_room_id'  => $request->roomId,
                ];
                $userChatRoom = UserChatRoom::create($dataMember);
                if ($userChatRoom) {
                    $userChatRoomId[] = $userChatRoom->id;
                } else {
                    UserChatRoom::destroy($userChatRoomId);
                    return ['message' => "Có lỗi xảy ra, vui lòng thử lại sau"];
                    break;
                }
            }
            return 'OK';
        } else {
            return ['error' => 'Đây là phòng chung, không cần thêm thành viên'];
        }
    }
}
