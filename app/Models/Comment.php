<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content',
        'rating',
        'user_id',
        'location_id',
    ];

    // 留言屬於使用者
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 留言屬於特定地點
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
