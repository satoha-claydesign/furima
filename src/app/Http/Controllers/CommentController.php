<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function comment(CommentRequest $request, Item $item, Comment $comment)
    {
        if (Auth::check()) {
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

            if ($item->comments) {
                // 関連するコメントのコレクションを取得
                $comments = $item->comments;
            }
            // 1. Controller側: Eager Loadingでデータを取得
            $comments = Comment::with('user.profile')->where('item_id',$item->id)->get();
            $commentsCount = $comments->count();

            // 2. データの整形
            $userComments = $comments->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'commentUserName' => $comment->user->name ?? 'コメントしたユーザー',
                    'commentUserImage' => $comment->user->profile->image ?? 'default.jpg',
                    'commentBody' => $comment->body,
                ];
            })->toArray();

            return view('item.show', compact('comment','item', 'categories', 'allcategories', 'likesCount', 'commentsCount', 'comments','userComments'));
        }
        else {
            return redirect('/login');
        }
    }
}
