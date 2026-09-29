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
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $user = User::create([
            'name' => 'Jane Doe',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

// 3. 使用 Factory 生成 10 個地點，且每個地點自動帶有 2 則評論
        Location::factory(10)
            ->has(Comment::factory()->count(2)->state(function (array $attributes, Location $location) use ($user) {
                return ['user_id' => $user->id]; // 使用者留下的評論
            }))
            ->create(['user_id' => $admin->id]);
    }
}
