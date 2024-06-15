<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $icons = [
            [
                'image' => 'bags.svg',
                'name' => 'Bags',
            ],
            [
                'image' => 'boots.svg',
                'name' => 'Boots',
            ],
            [
                'image' => 'first-aid.svg',
                'name' => 'First-Aid',
            ],
            [
                'image' => 'gloves.svg',
                'name' => 'Gloves',
            ],
            [
                'image' => 'hats.svg',
                'name' => 'Hats',
            ],
            [
                'image' => 'hiking-sticks.svg',
                'name' => 'Hiking-Sticks',
            ],
            [
                'image' => 'jacket.svg',
                'name' => 'Jacket',
            ],
            [
                'image' => 'pants.svg',
                'name' => 'Pants',
            ],
            [
                'image' => 'rain-coat.svg',
                'name' => 'Rain-Coat',
            ],
            [
                'image' => 'shirt.svg',
                'name' => 'Shirt',
            ],
            [
                'image' => 'sleeping-bag.svg',
                'name' => 'Sleeping-Bag',
            ],
            [
                'image' => 'snacks.svg',
                'name' => 'Snacks',
            ],
            [
                'image' => 'socks.svg',
                'name' => 'Socks',
            ],
            [
                'image' => 'tablet.svg',
                'name' => 'Tablet',
            ],
            [
                'image' => 'torch.svg',
                'name' => 'Torch',
            ],
            [
                'image' => 'towel.svg',
                'name' => 'Towel',
            ],
        ];

        DB::table('icons')->insert($icons);
    }
}
