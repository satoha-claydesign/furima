<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function comment(Request $request, Item $item, Comment $comment)
    {
        $item = Item::withCount('likes')->find($request->id);
        $categories = $item->categories();
        $allcategories = Category::all();
        $likesCount = $item->likes_count;

        $item_id = $request->id;
        $user_id = Auth::id();
        $body = $request->body;

        $comment = new Comment();
        $comment->body = $body;
        $comment->user_id = $user_id; // ユーザーを関連付け
        $comment->item_id = $item_id; // アイテムを関連付け
        $comment->save();

        return view('item.show', compact('comment','item', 'categories', 'allcategories', 'likesCount'));
    }
}
