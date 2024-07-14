<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Destination;
use App\Models\Image;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create('en_US');
    }

    public function run(): void
    {
        Activity::insert([
            [
                'title' => 'Hiking',
                'slug' => 'hiking',
                'description' => 'Hiking description.',
            ],
            [
                'title' => 'Paragliding',
                'slug' => 'paragliding',
                'description' => 'Paragliding description.',
            ],
            [
                'title' => 'Rafting',
                'slug' => 'rafting',
                'description' => 'Rafting description.',
            ],
            [
                'title' => 'Bungee Jumping',
                'slug' => 'bungee',
                'description' => 'Bungee Jumping description.',
            ],
        ]);

        Image::insert([
            [
                'image_name' => $this->faker->image('public/uploaded-images/activity-gallery-images', 640, 480, null, false),
                'imageable_id' => 1,
                'imageable_type' => 'App\Models\Activity',
            ],
            [
                'image_name' => $this->faker->image('public/uploaded-images/activity-gallery-images', 640, 480, null, false),
                'imageable_id' => 2,
                'imageable_type' => 'App\Models\Activity',
            ],
        ]);
    }
}
