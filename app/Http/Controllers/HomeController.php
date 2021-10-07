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
        return view('home');
    }

    public function userLogin()
    {
        $user = Auth::user();
        return $user;
    }

    public function update($id, Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:10', 'max:50'],
            'email' => ['required', 'max:50', 'string', 'email'],
            'about_me' => ['required', 'min:10', 'max:255']
        ]);
        unset($data['_token']);
        $status = User::where('id', $id)->update($data);
        if ($status) {
            return back()->with('success', 'Đã thay đổi thông tin thành công');
        } else {
            return back()->with('error', 'Thay đổi thông tin thất bại, xin vui lòng thử lại sau');
        }
    }

    public function updateAvatar($id, Request $request)
    {
        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            $fileName = $file->getClientOriginalName();
            $path = 'images/avatars/' . $fileName;
            $file->move('images/avatars', $fileName);
        } else {
            return back();
        }

        User::where('id', $id)->update(['avatar' => $path]);
        return back();
    }
}
