<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Comment;
use App\Models\User;
use App\Models\Order;
use App\Models\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        $items = Item::with('orders')->get();
        $orders = Order::all();
        $conditions = config('condition');
        return view('index', compact('items', 'categories', 'orders'));
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

    public function show($id, Item $item, Order $order)
    {
        $item = Item::withCount('likes')->with('orders')->find($id);
        $likesCount = $item->likes_count;
        
        $orders = Order::find($item->order_id);
        $categories = Item::find($id)->categories();
        $allcategories = Category::all();

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

        return view('item.show', compact('item', 'categories', 'orders', 'allcategories', 'likesCount', 'commentsCount', 'comments','userComments'), [$userComments = 'userComments']); // posts.showビューにデータを渡す
    }

    public function sell()
    {
        $categories = Category::all();
        $allcategories = Category::all();
        $items = Item::with('orders')->get();
        $orders = Order::all();
        $conditions = config('condition');
        return view('item.sell', compact('items', 'categories', 'allcategories', 'orders'));
    }

    public function store(Request $request, Item $item, Sell $sell)
    {
        if ($request->has('back')) {
            return redirect('/')->withInput();
        }

        $item = Item::create($request->all());
        $item->categories()->attach(request()->allcategory_ids);  //attachメソッドを利用して、中間テーブルにデータを追加

        if ($request->hasFile('image')) {
        // 既存画像の削除 (storage/app/public/images/ の中のパス)
            $dir = 'img';
        // 新しい画像の保存
            $file= $request->file('image');
            $file_name = $request->file('image')->getClientOriginalName();
            $path = $file->storeAs('public/images', $file_name); // storage/app/public/img/ に保存
            $item->image = basename($path);
        }
        $item->save();

        $user = auth()->user();
        $sell = Sell::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $items = Item::all();
        $allcategories = Category::all();
        return redirect('/')->with('message', '商品を追加しました');
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
