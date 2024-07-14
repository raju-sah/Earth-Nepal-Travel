<?php

namespace Database\Seeders;

use App\Enums\MonthType;
use App\Enums\SeasonType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seasons = [
            [
                'title' => 'Spring (March, May)',
                'type' => SeasonType::Spring->value,
                'starting_month' => MonthType::March->value,
                'ending_month' => MonthType::May->value,
            ],
            [
                'title' => 'Summer (June, August)',
                'type' => SeasonType::Summer->value,
                'starting_month' => MonthType::June->value,
                'ending_month' => MonthType::August->value,
            ],
            [
                'title' => 'Autumn (September, November)',
                'type' => SeasonType::Autumn->value,
                'starting_month' => MonthType::September->value,
                'ending_month' => MonthType::November->value,
            ],
            [
                'title' => 'Winter (December, February)',
                'type' => SeasonType::Winter->value,
                'starting_month' => MonthType::December->value,
                'ending_month' => MonthType::February->value,
            ],
            [
                'title' => 'All Year Round (December, February)',
                'type' => SeasonType::AllYearRound->value,
                'starting_month' => MonthType::January->value,
                'ending_month' => MonthType::December->value,
            ],
        ];

        DB::table('seasons')->insert($seasons);
    }
}
