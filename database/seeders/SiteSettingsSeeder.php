<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SiteSetting;
class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $siteSettingsData = [
            'id' => 1,
            'logo' => 'logo',
            'favicon' => 'favicon',
            'name' => 'Travel App',
            'email' => 'info@onvirotech.com',
            'phone' => '+977-1-4950179',
            'contact_address' => 'Kamal Pokhari, Nilgirimarg, Kathmandu',
            'map_url' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d849.7014918123841!2d85.32814826689733!3d27.7098522955887!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1996e42f4543%3A0x47c87c04d34cf86b!2sOnviro%20Tech%20P.Ltd.!5e0!3m2!1sen!2snp!4v1709286791896!5m2!1sen!2snp',
            'working_hours' => '9:30 am to 6:00 pm',
            'copyright_text' => 'Copyright © 2024 All Rights Reserved.',
            'primary1_color' => '#ffffff',
            'secondary1_color' => '#000000',
            'primary2_color' => '#ff0000',
            'secondary2_color' => '#00ff00',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        SiteSetting::updateOrInsert(['id' => 1], $siteSettingsData);

    }
}
