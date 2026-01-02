<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    //
    public function index()
    {
        if (Auth::check()) {
            $user = auth()->user()->load('profile');
            return view('mypage.index', compact('user')); // mypage.indexビューにデータを渡す
        } else {
            return redirect('/login');
        }
    }

    public function profile()
    {
        if (Auth::check()) {
            $user = auth()->user()->load('profile');
            return view('mypage.profile', compact('user')); // mypage.profileビューにデータを渡す
        } else {
            return redirect('/login');
        }
    }

    public function update(Request $request, User $user)
    {
        $user = User::with(['profile'])->find($request->id);
        // User情報の更新
        $user->update([
            'name' => $request->name,
        ]);

        if ($request->hasFile('image')) {
        
        // 新しい画像の保存
            $file= $request->file('image');
            $file_name = $request->file('image')->getClientOriginalName();
            $path = $file->storeAs('public/images/profiles', $file_name); // storage/app/public/img/ に保存
            $user->profile()->updateOrCreate( // リレーションメソッドを呼び出す
            ['user_id' => $user->id],    // 検索条件
                [                            // 更新/作成データ
                    'image' => basename($path),
                    'postalCode' => $request->postalCode,
                    'address' => $request->address,
                    'building' => $request->building,
                ]
        );
        }

        return redirect('/mypage');
    }
}

