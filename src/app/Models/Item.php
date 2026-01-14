<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use App\Models\Order;


class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'image',
        'name',
        'price',
        'brand',
        'description',
        'condition'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'item_category', 'item_id', 'category_id');
    }

    public function likes()
    {
        // User / Post has many Likes
        return $this->hasMany(Like::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'comments', 'item_id', 'user_id')->withPivot('body');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
