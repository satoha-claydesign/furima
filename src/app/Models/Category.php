<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name'];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_category', 'category_id', 'item_id')->withPivot('category_id', 'item_id');
    }
}
