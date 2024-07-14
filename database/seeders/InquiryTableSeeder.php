<?php

namespace Database\Seeders;

use App\Enums\InquiryType;
use App\Models\Inquiry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Enums\StatusType;
use Faker\Factory as Faker;

class InquiryTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $numberOfInquirys = 10;

        for ($i = 0; $i < $numberOfInquirys; $i++) {
            Inquiry::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'subject' => $faker->sentence,
                'type' => InquiryType::Contact->value,
                'message' => $faker->sentence,
                'status' => StatusType::Pending->value,
            ]);
        }
    }
}
