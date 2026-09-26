<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Location;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. 建立一個 Admin 帳號與一個一般 User 帳號
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $user = User::create([
            'name' => 'Jane Doe',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // 2. 建立柏林的 Pfand 回收點測試資料
        $loc1 = Location::create([
            'name' => 'REWE Supermarket Alexanderplatz',
            'address' => 'Alexanderstraße 1, 10178 Berlin',
            'latitude' => 52.5219,
            'longitude' => 13.4132,
            'description' => 'Has 3 Pfand machines, open late until 22:00.',
            'user_id' => $user->id,
        ]);

        $loc2 = Location::create([
            'name' => 'Edeka Späti Kreuzberg',
            'address' => 'Skalitzer Str. 45, 10997 Berlin',
            'latitude' => 52.4991,
            'longitude' => 13.4215,
            'description' => 'Accepts glass beer bottles manually at the counter.',
            'user_id' => $admin->id,
        ]);

        // 3. 建立測試留言
        Comment::create([
            'content' => 'The machine was fast and clean! No queue on Tuesday afternoon.',
            'rating' => 5,
            'user_id' => $user->id,
            'location_id' => $loc1->id,
        ]);

        Comment::create([
            'content' => 'One of the machines was out of order, but staff helped out.',
            'rating' => 3,
            'user_id' => $admin->id,
            'location_id' => $loc1->id,
        ]);
        // 新增 Edeka ($loc2) 的測試留言
        Comment::create([
            'content' => 'Great place to drop off empty beer glass bottles!',
            'rating' => 5,
            'user_id' => $user->id,
            'location_id' => $loc2->id, // <-- 注意這裡是 loc2
        ]);
    }
}
