<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'title' => 'Admin Role',
                'slug' => 'admin-role'
            ],

            [
                'title' => 'Staff Role',
                'slug' => 'staff-role'
            ],
        ];

        DB::table('roles')->insert($roles);

        Role::first()->permissions()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25]);

        Role::skip(1)->take(1)->first()->permissions()->attach([1,2,6,7,8,9]);

    }
}
