<?php

namespace Database\Seeders;

use App\Models\TermPrivacyItem;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     AdminSeeder::class,
        //     WelcomeItemSeeder::class,
        // CounterItemSeeder::class,
        // HomeItemSeeder::class,
        // AvoutItemSeeder::class,
        // ContactItemSeeder::class,
        // TermPrivacyItemSeeder::class,
        // SettingSeeder::class,
        //SeederRule,
        //CooperatorSeeder

        // ]);
        $this->call([
            CooperatorSeeder::class,
        ]);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
