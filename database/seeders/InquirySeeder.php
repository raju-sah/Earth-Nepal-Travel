<?php

namespace Database\Seeders;

use App\Enums\InquiryType;
use App\Models\Package;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class InquirySeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }

    // Custom method to generate model types
    public function modelType()
    {
        $modelTypes = [
            'Package', 
            // 'Destination',
            //  'Activity'
            'Inquiry',
            ];
        $modelName = $modelTypes[array_rand($modelTypes)];
        return 'App\Models\\' . $modelName;
    }
    public static function getRandomType()
    {
        $types = [
            InquiryType::Package,
            // InquiryType::Destination,
            // InquiryType::Activity,
            InquiryType::Contact
        ];

        return $types[array_rand($types)];
    }

    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {
            DB::table('inquiries')->insert([
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'phone' => $this->faker->phoneNumber,
                'subject' => $this->faker->word,
                'type' => $this->getRandomType()->value,
                'message' => $this->faker->text,
                'status' => 1,
                'inquiriable_type' => $this->modelType(), 
                'inquiriable_id' => Package::pluck('id')->random(),
                'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
