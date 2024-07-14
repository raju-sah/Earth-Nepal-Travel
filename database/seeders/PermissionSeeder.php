<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [//1
                'title' => 'Access Dashboard',
                'slug' => 'access-dashboard'
            ],

            [//2
                'title' => 'Access User Page',
                'slug' => 'access-user-page'
            ],

            [//3
                'title' => 'Add User',
                'slug' => 'add-user'
            ],

            [//4
                'title' => 'Delete User',
                'slug' => 'delete-user'
            ],

            [//5
                'title' => 'Edit User',
                'slug' => 'edit-user'
            ],

            [//6
                'title' => 'Access Activity Page',
                'slug' => 'access-activity-page'
            ],

            [//7
                'title' => 'Add Activity',
                'slug' => 'add-activity'
            ],

            [//8
                'title' => 'Delete Activity',
                'slug' => 'delete-activity'
            ],

            [//9
                'title' => 'Edit Activity',
                'slug' => 'edit-activity'
            ],

            [//10
                'title' => 'Access Destination Category Page',
                'slug' => 'access-destination-category-page'
            ],

            [//11
                'title' => 'Add Destination Category',
                'slug' => 'add-destination-category'
            ],

            [//12
                'title' => 'Edit Destination Category',
                'slug' => 'edit-destination-category'
            ],

            [//13
                'title' => 'Delete Destination Category',
                'slug' => 'delete-destination-category'
            ],

            [//14
                'title' => 'Access Destination Page',
                'slug' => 'access-destination-page'
            ],

            [//15
                'title' => 'Add Destination',
                'slug' => 'add-destination'
            ],

            [//16
                'title' => 'Delete Destination',
                'slug' => 'delete-destination'
            ],

            [//17
                'title' => 'Edit Destination',
                'slug' => 'edit-destination'
            ],

            [ //18
                'title' => 'Add Permission',
                'slug' => 'add-permission'
            ],

            [//19
                'title' => 'Edit Permission',
                'slug' => 'edit-permission'
            ],

            [//20
                'title' => 'Delete Permission',
                'slug' => 'delete-permission'
            ],

            [//21
                'title' => 'Access Permission Page',
                'slug' => 'access-permission-page'
            ],

            [//22
                'title' => 'Add Role',
                'slug' => 'add-role'
            ],

            [//23
                'title' => 'Edit Role',
                'slug' => 'edit-role'
            ],

            [//24
                'title' => 'Delete Role',
                'slug' => 'delete-role'
            ],

            [//25
                'title' => 'Access Roles Page',
                'slug' => 'access-role-page'
            ],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
