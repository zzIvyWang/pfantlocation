<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. 引入命名空間
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasFactory; // 2. 在 class 內部載入 HasFactory trait

    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'description',
        'user_id',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
