<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Job;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Job::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),

            'title' => $this->faker->jobTitle,

            // Limit description to 255 characters
            'description' => $this->faker->text(255),

            'salary' => $this->faker->numberBetween(40000, 120000),

            'tags' => implode(', ', $this->faker->words(3)),

            'job_type' => $this->faker->randomElement(['Full-time', 'Part-time', 'Contract', 'Temporary', 'Internship', 'Volunteer', 'On-Call']),

            'remote' => $this->faker->boolean,

            // Limit requirements and benefits to 255 characters
            'requirements' => $this->faker->text(255),
            'benefits' => $this->faker->text(255),

            'address' => $this->faker->streetAddress,

            'city' => $this->faker->city,

            'state' => $this->faker->state,

            'zipcode' => $this->faker->postcode,

            'contact_email' => $this->faker->safeEmail,

            'contact_phone' => $this->faker->phoneNumber,

            'company_name' => $this->faker->company,

            // Limit company description to 255 characters
            'company_description' => $this->faker->text(255),

            'company_logo' => $this->faker->imageUrl(100, 100, 'business', true, 'logo'),

            'company_website' => $this->faker->url,
        ];
    }
}