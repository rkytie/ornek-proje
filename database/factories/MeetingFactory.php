<?php

namespace Database\Factories;

use App\Models\Meeting;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeetingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Meeting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "phone" => $this->faker->phoneNumber(),
            "date" => $this->faker->date(),
            "time" => $this->faker->time(),
            "user_id" => 4,
            "customer_id" => 16
        ];
    }
}
