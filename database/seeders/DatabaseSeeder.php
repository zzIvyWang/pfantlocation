<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. 建立一個 Admin 帳號與一個一般 User 帳號
        $admin = User::factory()->create([
            'name' => 'Ivy Wang',
            'email' => 'admin@admin.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $users = User::factory(10)->create();

        // 3. 使用 Factory 生成 10 個地點，且每個地點自動帶有 2 則評論
        Location::factory(10)
            ->has(Comment::factory()->count(2)->state(function (array $attributes, Location $location) use ($users) {
                return ['user_id' => $users->random()->id]; // 使用者留下的評論
            }))
            ->create(['user_id' => $admin->id]);
    }
}
