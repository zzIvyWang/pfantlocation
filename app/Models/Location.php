<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'latitude',
        'longitude',
    ];

    // 地點屬於發布的使用者
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // 地點擁有許多留言
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
