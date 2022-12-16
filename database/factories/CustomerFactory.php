<?php

namespace Database\Factories;

use App\Models\Progress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $progress_id = Progress::pluck('id')->toArray();
        return [
            'name' => $this->faker->name(),
            'memo' => $this->faker->text(),
            'tel' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'url' => 'https://github.com/shundahoy',
            'progress_id' => 1,
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
