<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\PackageReview;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PackageReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $faker;



    public function run(): void
    {
        $faker = Faker::create();
        
        for ($i = 0; $i < 50; $i++) {
            DB::table('package_reviews')->insert([
                [
                    'fullname' => $faker->name,
                    'email' => $faker->email,
                    'rating' => $faker->numberBetween(1, 5),
                    'review_text' => $faker->text(),
                    'status' => 1,
                    'package_id' => Package::pluck('id')->random(),
                    'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                    'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
                ]
            ]);
        }
    }
}
