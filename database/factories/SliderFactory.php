<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

class SliderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Slider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "status" => rand(0, 1),
            "title" => $this->faker->name(),
            "image" => $this->faker->imageUrl(1920,1080,"houses",false),
            "description" => $this->faker->paragraph(1,false),
            "user_id" => User::inRandomOrder()->first()->id
        ];
    }
}
