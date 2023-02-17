<?php

namespace Database\Seeders;

use Unsplash\Search;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\Slider::factory(3)->create();
        $n = 20;
        $total = 138728;

        $images = [
            "https://wallpapercave.com/wp/wp2587127.jpg",
            "https://wallpaperaccess.com/full/138728.jpg",
            "https://images.unsplash.com/photo-1552319704-41c50c38c26e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8M3x8fGVufDB8fHx8&w=1000&q=80"
        ];

        for ($i = 1; $i <= $n; $i++) {
            $total++;
            $images[] = "https://wallpaperaccess.com/full/" . rand(13000, 20000) . ".jpg";
        }


        foreach ($images as $index => $image) {
            $total=$index+1;
            $data = [
                "status" => rand(0, 1),
                "image" => $image,
                "title" => "Place For Commercial $total",
                "description" => "This is real estate website template $total.",
                "user_id" => User::inRandomOrder()->first()->id
            ];
            if($index==0){
                $data["is_cover"] =true;
            }
            Slider::create($data);
        }
    }
}
