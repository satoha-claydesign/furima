<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    //
    public function likeItem(Request $request, Item $item)
    {

        // ログインユーザーのidを取得
        $user_id = Auth::id();
        $item = Item::find($request->id);
        $categories = $item->categories();
        $allcategories = Category::all();


        //「いいね」していない場合は，likesテーブルにレコードを追加
        $like = new Like();
        $like->user_id = $user_id;
        $like->item_id = $item->id;
        $like->save();

        // いいねの数を取得
        $item = Item::withCount('likes')->find($request->id);
        $likesCount = $item->likes_count;

        // フロントにいいねの数を返す
        return view('item.show', compact('item', 'categories', 'allcategories', 'likesCount'));
    }

    public function dislikeItem(Request $request, Item $item)
    {

        // ログインユーザーのidを取得
        $user_id = Auth::id();
        $item = Item::find($request->id);
        $categories = $item->categories();
        $allcategories = Category::all();

        $liked_item = $item->likes()->where('user_id', $user_id);

        // 既に「いいね」をしていた場合は，likesテーブルからレコードを削除
        $liked_item->delete();

        // いいねの数を取得
        // いいねの数を取得
        $item = Item::withCount('likes')->find($request->id);
        $likesCount = $item->likes_count;

        // フロントにいいねの数を返す
        return view('item.show', compact('item', 'categories', 'allcategories', 'likesCount'));
    }

}
