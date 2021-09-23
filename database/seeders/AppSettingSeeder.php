<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            "phone" => json_encode([
                [
                    'phone_number' => 123456789,
                    'contact_city' => "kathmandu",
                ]
            ]),
            "name" => "Lekha Bidhi",
            "logo_url" => "https://www.nectardigit.com/uploads/pictures/2289964f3f3e56bc2f88f43821fb7529site_logo.png",
            "website_content_format" => "English",
            "website_content_item" => json_encode(["slider","information","features","faq","testimonial","user","nav","team","subscriber","mediaLibrary"]),
        ];
        DB::table('app_settings')->insert($data);
    }
}
