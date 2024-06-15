<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaseMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $base_menus = [
            [
                'title' => 'Top Menu',
            ],
            [
                'title' => 'Footer Menu',
            ],
        ];

        DB::table('base_menus')->insert($base_menus);
    }
}
