<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
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

    public function show($id)
    {
        $item = Item::find($id); // または Post::find($id);
        $categories = Item::find($id)->categories();
        $allcategories = Category::all();
        return view('item.show', compact('item', 'categories', 'allcategories')); // posts.showビューにデータを渡す
    }
}
