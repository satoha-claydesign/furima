<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        $items = Item::all();
        $conditions = config('condition');
        return view('index', ['items' => $items],['categories' => $categories]);
    }

    public function indexLogin()
    {
        $categories = Category::all();
        $items = Item::all();
        $conditions = config('condition');
        return view('index', ['items' => $items],['categories' => $categories]);
    }

    public function show($id, Item $item)
    {
        $item = Item::withCount('likes')->find($id);
        $likesCount = $item->likes_count;

        $categories = Item::find($id)->categories();
        if ($item) {
            // 関連するコメントのコレクションを取得
            $comments = $item->comments;
        }
        $allcategories = Category::all();
        // 1. Controller側: Eager Loadingでデータを取得
        $comments = Comment::with('user.profile')->where('item_id',$item->id)->get();

        // 2. データの整形
        $userComments = $comments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'commentUserName' => $comment->user->name ?? 'コメントしたユーザー',
                'commentUserImage' => $comment->user->profile->image ?? 'default.jpg',
                'commentBody' => $comment->body,
            ];
        })->toArray();

        

        return view('item.show', compact('item', 'categories', 'allcategories', 'likesCount', 'comments','userComments'), [$userComments = 'userComments']); // posts.showビューにデータを渡す
    }

}
