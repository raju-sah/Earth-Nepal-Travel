<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaticPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('static_pages')->insert([
            [
                'title' => 'Home',
                'url' => '/',
            ],
            [
                'title' => 'About Us',
                'url' => '/about-us',
            ],
            [
                'title' => 'Our Team',
                'url' => '/our-team',
            ],
            [
                'title' => 'Our Services',
                'url' => '/our-services',
            ],
            [
                'title' => 'Contact Us',
                'url' => '/contact-us',
            ],
            [
                'title' => 'Booking Form',
                'url' => '/booking-form',
            ],
        ]);
    }
}
