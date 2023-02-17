<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "status" => false,
                "name" => "facebook",
                "link" => null,
            ],
            [
                "status" => false,
                "name" => "instagram",
                "link" => null,
            ],
            [
                "status" => false,
                "name" => "whatsapp",
                "link" => null,
            ],
            [
                "status" => false,
                "name" => "twitter",
                "link" => null,
            ],
            [
                "status" => false,
                "name" => "youtube",
                "link" => null,
            ],
            [
                "status" => false,
                "name" => "linkedin",
                "link" => null,
            ],
            [
                "status" => false,
                "name" => "email",
                "link" => null,
            ],
        ];

        foreach ($data as $social_media) {
            SocialMedia::updateOrCreate(
                [
                    "name" => $social_media["name"]
                ],
                [
                    "status" => $social_media["status"],
                    "link" => $social_media["link"]
                ]
            );
        }
    }
}
