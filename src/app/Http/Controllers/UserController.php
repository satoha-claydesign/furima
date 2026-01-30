<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Item;
use App\Models\Sell;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        if (Auth::check()) {
            $user = auth()->user()->load('profile');
            $items = Item::all();

            if ($request->page) {
                $page = $request->page;
                if  ($page === 'buy') {
                    $user = auth()->user()->load('orders');
                    $user_id = $user->id;
                    $items = Item::with('orders')->whereHas('orders', function($query) use ($user_id) {
                    $query->where('user_id', $user_id)->where('status', 'complete');
                    })->get();
                    return view('mypage.index', compact('user', 'items', 'page') );
                }
                else {
                    $user = auth()->user()->load('sells');
                    $user_id = $user->id;
                    $items = Item::with('sell')->whereHas('sell', function($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                    })->get();
                return view('mypage.index', compact('user', 'items', 'page') );
                }
            }
            else {
                    $user = auth()->user()->load('sells');
                    $user_id = $user->id;
                    $items = Item::with('sell')->whereHas('sell', function($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                    })->get();
                    return view('mypage.index', compact('user', 'items') );
            }
        }
        else {
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

    public function update(ProfileRequest $request, User $user)
    {
        $validated = $request->validated();
        $user = User::with(['profile'])->find($request->id);
        // User情報の更新
        $user->update([
            'name' => $validated['name'],
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

