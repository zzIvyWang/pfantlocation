<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'location_id',
        'content',
    ];

    // 留言屬於使用者
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // 留言屬於特定地點
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
