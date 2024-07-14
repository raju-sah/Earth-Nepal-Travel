<?php

namespace Database\Seeders;

use App\Models\DestinationCategory;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DestinationCategorySeeder extends Seeder
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
        $categories = [
            [
                'title' => 'Mountains',
                'slug' => 'mountains',
                'image' => $this->faker->image('public/uploaded-images/destination-category-images', 640, 480, null, false),
                'description' => 'description1',
                'image_caption' => 'mountain_image',
            ],
            [
                'title' => 'Hills',
                'slug' => 'hills',
                'image' => $this->faker->image('public/uploaded-images/destination-category-images', 640, 480, null, false),
                'description' => 'description2',
                'image_caption' => 'image_caption2',
            ],
            [
                'title' => 'Terai',
                'slug' => 'terai',
                'image' => $this->faker->image('public/uploaded-images/destination-category-images', 640, 480, null, false),
                'description' => 'description3',
                'image_caption' => 'image_caption3',
            ],
        ];
        DestinationCategory::insert($categories);
    }
}
