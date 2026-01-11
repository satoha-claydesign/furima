<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Item::query();

        $query = $this->getSearchQuery($request, $query);

        $items = $query->paginate(6);

        $categories = Category::all();
        $conditions = config('condition');

        $viewData['keyword'] = $keyword;
        return view('index', compact('items', 'categories'), $viewData, $keyword);
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

        return view('item.show', compact('item', 'categories', 'allcategories', 'likesCount', 'commentsCount', 'comments','userComments'), [$userComments = 'userComments']); // posts.showビューにデータを渡す
    }


    private function getSearchQuery($request, $query)
    {
        if(!empty($request->keyword)) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%');
            });
        }
        return $query;
    }

}
