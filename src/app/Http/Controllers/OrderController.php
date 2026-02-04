<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Comment;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;

class OrderController extends Controller
{
    //
    public function purchase($id, Item $item, Order $order, Request $request)
    {
        $item = Item::find($request->id);
        if (Auth::check()) {
            $user = auth()->user()->load('profile');

            $order = Order::create([
            'item_id' => $item->id,
            'user_id' => Auth::id(),
            'order_postalCode'  => $user->profile?->postalCode,
            'order_address'  => $user->profile?->address,
            'order_building'  => $user->profile?->building,
            'payment' => '1',
            'status' => 'pending',
        ]);
            return view('purchase.index', compact('user', 'item', 'order'));
        }
        else {
            return redirect('/login');
        }
    }

    public function payment($id, Item $item, Order $order, PurchaseRequest $request)
    {
        // バリデーション済みデータを取得
        $validated = $request->validated();
        $paymentMethod = $validated['payment'];

        // ユーザー情報の取得
        $user = auth()->user()->load('profile');

        // IDを元に各モデルを取得（引数での型ヒンティングより確実）
        $item = Item::findOrFail($request->item_id);
        $order = Order::findOrFail($request->order_id);

        // 支払い方法を更新
        $order->update([
            'payment' => $paymentMethod
        ]);

        return view('purchase.index', compact('user', 'item', 'order'))
            ->with('payment', $paymentMethod);
    }

    public function address($id, Item $item, Request $request, Order $order)
    {
        $user = auth()->user()->load('profile');
        $order = Order::find($request->order_id);
        $item = Item::find($request->item_id);
        return view('purchase.address', compact('user', 'item', 'order'));
    }

    public function updateAddress($id, Item $item, PurchaseRequest $request, Order $order)
    {
        // 1. 指定したIDの注文データを取得（見つからない場合は404エラーを返す）
        $order = Order::findOrFail($request->order_id);
        // 2. リクエストから必要な項目のみを抽出
        $updateData = $request->validated([
            'order_postalCode',
            'order_address',
            'order_building',
        ]);
        // 3. 取得済みのインスタンスに対して更新を実行
        $order->update($updateData);
        $user = auth()->user()->load('profile');
        $item = Item::find($order->item_id);
        
        return view('purchase.index', compact('user', 'item', 'order'));
    }

    public function complete($id, Item $item, Order $order, PurchaseRequest $request)
    {
        $order = Order::find($request->order_id);
        $order->status = 'complete';
        $order->save(); // データベースに保存

        Order::where('item_id', $request->item_id)
        ->where('status', 'pending')
        ->delete();
        $orders = Order::all();

        $categories = Category::all();
        $items = Item::all();
        $conditions = config('condition');
        return redirect()->away('https://buy.stripe.com/test_6oUbJ14xZ2Qp8zz5gsbV600');
    }

}
