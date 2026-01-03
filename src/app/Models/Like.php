<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\User;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'id'
    ];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // リレーション (Like belongs to a User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
