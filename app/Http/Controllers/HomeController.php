<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        return $user;
    }

    public function userLogin()
    {
        $user = Auth::user();
        return $user;
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        if ($user->avatar === $request->avatar) {
            $avatar = $request->avatar;
        } else {
            if ($request->get('avatar')) {
                $image = $request->get('avatar');
                $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                \Image::make($request->get('avatar'))->save(public_path('images/avatars/') . $name);
                //create new image
                $avatar = 'http://54.255.90.148/images/avatars/' . $name;
            }
        }
        $data = [
            'name' => $request->name,
            'avatar' => $avatar,
        ];
        $status = User::where('id', $id)->update($data);
        if ($status == 1) {
            return ['message' => "Chỉnh sửa thông tin thành công"];
        } else {
            return ['message' => "Chỉnh sửa thông tin thất bại"];
        }
    }
}
