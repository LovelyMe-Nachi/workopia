<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load job listings from the file.
        $jobListings = include database_path('seeders/data/job_listings.php');

        // Get the ID of the user created by TestUserSeeder
        $testUserId = User::where('email', 'test@test.com')->value('id');

        // Get all other user IDs
        $userIds = User::where('email', '!=', 'test@test.com')->pluck('id')->toArray();

        foreach ($jobListings as $index => &$listing) {
            if ($index < 2) {
                // Assign a user id to listing
                $listing['user_id'] = $userIds[array_rand($userIds)];
            } else {
                // Assign the rest to random users
                $listing['user_id'] = $userIds[array_rand($userIds)];
            }

            // Add timestamps
            $listing['created_at'] = now();
            $listing['updated_at'] = now();
        }

        // Insert job listings
        DB::table('job_listings')->insert($jobListings);
    }
}