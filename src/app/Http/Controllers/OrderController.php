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
    public function purchase($id, Item $item, Request $request)
    {
        $item = Item::find($request->id);
        if (Auth::check()) {
            $user = auth()->user()->load('profile');
            return view('purchase.index', compact('user', 'item'));
        } else {
            return redirect('/login');
        }
    }

    public function payment($id, Item $item, Request $request)
    {
        $payment = $request->input('payment', '1');
        $user = auth()->user()->load('profile');
        $item = Item::find($request->item_id);
        return view('purchase.index', compact('user', 'item'), ['payment' => $payment]);
    }

}
