<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SeoSetting;

class SeoSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $seoSettingsData = [
            'id' => 1,
            'meta_title' => 'Discover Your Next Adventure with Our Travel App',
            'meta_keywords' => 'travel, adventure, explore, vacation, destination, journey, tourism',
            'meta_author' => 'Onviro Technology',
            'meta_robots' => 'index, follow',
            'meta_description' => 'Travel App Plan your dream vacation, explore exotic destinations, and book hotels with ease using our travel app. Download now and embark on unforgettable journeys!',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        SeoSetting::updateOrInsert(['id' => 1], $seoSettingsData);
    }
}
