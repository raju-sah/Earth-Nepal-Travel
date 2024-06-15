<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommonFaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $common_faqs = [
            [
                'question' => 'What is your cancellation policy?',
                'answer' => 'We do not offer any cancellation policy.',
            ],
            [
                'question' => 'How do I get my booking confirmation?',
                'answer' => 'We will send you an email with the booking confirmation.',
            ],
            [
                'question' => 'What if I have a medical emergency?',
                'answer' => 'We do not offer any medical emergency. Please call us at 1-800-123-4567.',
            ]
        ];

        DB::table('common_faqs')->insert($common_faqs);
    }
}
