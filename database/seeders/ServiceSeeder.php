<?php

namespace Database\Seeders;

use App\Enums\RateType;
use App\Enums\ServiceType;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ServiceSeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create('en_US');
    }

    public function run(): void
    {
        Service::insert([
            [
                'title' => 'Hotel Booking',
                'slug' => 'hotel-booking',
                'image' => $this->faker->image('public/uploaded-images/service-images', 640, 480, null, false),
                'description' => 'Hotel Booking',
                'type' => ServiceType::Hotel->value,
                'rate_type' => $this->faker->randomElement(RateType::cases()),
                'price' => $this->faker->numberBetween(100, 1000),
                'location' => $this->faker->address,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Flight',
                'slug' => 'flight',
                'image' => $this->faker->image('public/uploaded-images/service-images', 640, 480, null, false),
                'description' => 'Flight Booking',
                'type' => ServiceType::Flight->value,
                'rate_type' => $this->faker->randomElement(RateType::cases()),
                'price' => $this->faker->numberBetween(100, 1000),
                'location' => $this->faker->address,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Rafting',
                'slug' => 'rafting',
                'image' => $this->faker->image('public/uploaded-images/service-images', 640, 480, null, false),
                'description' => 'Rafting',
                'type' => ServiceType::Rafting->value,
                'rate_type' => $this->faker->randomElement(RateType::cases()),
                'price' => $this->faker->numberBetween(100, 1000),
                'location' => $this->faker->address,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
