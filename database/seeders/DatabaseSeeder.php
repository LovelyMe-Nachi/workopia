<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Truncate tables
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table(table: 'job_listings')->truncate();
        DB::table(table: 'users')->truncate();
        DB::table(table: 'job_user_bookmarks')->truncate();
        DB::table(table: 'applicants')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call(class: TestUserSeeder::class);
        $this->call(class: RandomUserSeeder::class);
        $this->call(class: JobSeeder::class);
        $this->call(class: BookmarkSeeder::class);
    }
}
