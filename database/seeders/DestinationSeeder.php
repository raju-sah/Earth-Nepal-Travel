<?php

namespace Database\Seeders;

use App\Models\Destination;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinationSeeder extends Seeder
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
        Destination::insert([
            [
                'title' => 'Kathmandu',
                'slug' => 'kathmandu',
                'image' => $this->faker->image('public/uploaded-images/destination-images', 640, 480, null, false),
                'country' => 'NP',
                'parent_id' => null,
                'destination_category_id' => 2,
            ],
            [
                'title' => 'Baudha',
                'slug' => 'baudha',
                'image' => $this->faker->image('public/uploaded-images/destination-images', 640, 480, null, false),
                'country' => 'NP',
                'parent_id' => 1,
                'destination_category_id' => 2,
            ],
            [
                'title' => 'Pokhara',
                'slug' => 'pokhara',
                'image' => $this->faker->image('public/uploaded-images/destination-images', 640, 480, null, false),
                'country' => 'NP',
                'parent_id' => null,
                'destination_category_id' => 3,
            ],
            [
                'title' => 'Fewa Lake',
                'slug' => 'fewa-lake',
                'image' => $this->faker->image('public/uploaded-images/destination-images', 640, 480, null, false),
                'country' => 'NP',
                'parent_id' => 3,
                'destination_category_id' => 3,
            ],
            [
                'title' => 'Solokhumbu',
                'slug' => 'solokhumbu',
                'image' => $this->faker->image('public/uploaded-images/destination-images', 640, 480, null, false),
                'country' => 'NP',
                'parent_id' => null,
                'destination_category_id' => 1,
            ],
            [
                'title' => 'Dharan',
                'slug' => 'dharan',
                'image' => $this->faker->image('public/uploaded-images/destination-images', 640, 480, null, false),
                'country' => 'NP',
                'parent_id' => null,
                'destination_category_id' => 3,
            ],
        ]);

        for ($i = 1; $i < 7; $i++) {
            DB::table('activity_destination')->insert([
                ['activity_id' => random_int(1, 2), 'destination_id' => $i],
            ]);
        }
    }
}
