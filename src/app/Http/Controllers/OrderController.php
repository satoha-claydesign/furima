<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\Comment;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

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
            'order_postalCode'  => $user->profile->postalCode,
            'order_address'  => $user->profile->address,
            'order_building'  => $user->profile->building,
            'payment' => '1',
            'status' => 'pending',
        ]);
            return view('purchase.index', compact('user', 'item', 'order'));
        } else {
            return redirect('/login');
        }
    }

    public function payment($id, Item $item, Order $order, Request $request)
    {
        $payment = $request->input('payment', '1');
        $user = auth()->user()->load('profile');
        $item = Item::find($request->item_id);
        $order = Order::find($request->order_id);

        $order->payment = $payment;
        Order::find($request->order_id)->update($request->only(['payment']));

        return view('purchase.index', compact('user', 'item', 'order'), ['payment' => $payment]);
    }

    public function complete($id, Item $item, Order $order, Request $request)
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
        return view('index', compact('items', 'orders', 'categories'))->with('message', '購入が完了しました');
    }

    public function address($id, Item $item, Request $request, Order $order)
    {
        $user = auth()->user()->load('profile');
        $order = Order::find($request->order_id);
        $item = Item::find($request->item_id);
        return view('purchase.address', compact('user', 'item', 'order'));
    }

    public function updateAddress($id, Item $item, Request $request, Order $order)
    {
        // 1. 指定したIDの注文データを取得（見つからない場合は404エラーを返す）
        $order = Order::findOrFail($request->order_id);
        // 2. リクエストから必要な項目のみを抽出
        $updateData = $request->only([
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

}
