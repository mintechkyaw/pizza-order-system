<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'phone' => '09464578685',
            'address' => 'Mergui',
            'password' => Hash::make('admin'),
        ]);
        User::create([
            'name' => 'minthantkyaw',
            'email' => 'min@user.com',
            'role' => 'user',
            'phone' => '09464578685',
            'address' => 'Mergui',
            'password' => Hash::make('user'),
        ]);
    }
}
