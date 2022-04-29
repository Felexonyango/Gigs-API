<?php

namespace Database\Factories;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::factory()->create();
        $user->assignRole(config('settings.user_types.user'));
        return [
            
            'title' => $this->faker->title,
            'company' => $this->faker->company,
            'location' => $this->faker->location,
            'website' => $this->faker->website,
            'email' => $this->faker->email,
            'description' => $this->faker->description,
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => $user->id,
        ];
    }
}
