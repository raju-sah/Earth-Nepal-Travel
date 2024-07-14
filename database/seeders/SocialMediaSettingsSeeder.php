<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SocialMediaSetting;
class SocialMediaSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $socialMediaSettings = [
            [
                'name' => 'Facebook',
                'slug' => 'facebook',
                'social_icon' => 'facebook_icon.png',
                'social_link' => 'https://www.facebook.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Twitter',
                'slug' => 'twitter',
                'social_icon' => 'twitter_icon.png',
                'social_link' => 'https://www.twitter.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        SocialMediaSetting::insert($socialMediaSettings);

    }
}
