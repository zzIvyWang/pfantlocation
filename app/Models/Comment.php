<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. 引入
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory; // 2. 載入

    protected $fillable = [
        'content',
        'rating',
        'user_id',
        'location_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
