<?php

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'status' => $this->faker->randomElement(['new', 'contacted', 'qualified', 'lost']),
            'source' => $this->faker->word,

        ];
    }
}
