<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Like;

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
}
