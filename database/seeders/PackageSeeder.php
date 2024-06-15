<?php

namespace Database\Seeders;

use App\Enums\DifficultyLevelType;
use App\Enums\DurationType;
use App\Enums\PackageHighlightType;
use App\Models\Package;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $faker;

    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i < 5; $i++) {
            $package = new Package([
                'image' => $faker->image('public/uploaded-images/package-banner-images', 640, 480, null, false),
                'title' => $title = $faker->city,
                'slug' => Str::slug($title),
                'duration_type' => $faker->randomElement(DurationType::cases())->value,
                'duration_value' => $faker->numberBetween(1, 30),
                'difficulty_level' => DifficultyLevelType::Easy->value,
                'difficulty_level_icon' => 'easy.svg',
                'min_age' => $faker->numberBetween(1, 100),
                'max_age' => $faker->numberBetween(1, 100),
                'overview' => $faker->text(150),
                'starting_location' => $faker->words(3, true),
                'ending_location' => $faker->words(3, true),
                'max_altitude' => $faker->numberBetween(1000, 5000),
                'view_count' => $faker->numberBetween(1000, 5000),
                'highlight' => $faker->randomElement(PackageHighlightType::cases())->value,
                'status' => $faker->boolean,
                'user_id' => 1,
                'created_at' => $faker->dateTimeBetween('-1 year'),
            ]);

            $package->save();

            $package->seasons()->attach(random_int(1, 5));
            $package->activities()->attach([1, 2]);
            $package->destinations()->attach(random_int(1, 6));
            $package->services()->attach(random_int(1, 5));
        }
    }

}
