<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogsTableSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'user_id' => 1,
                'title' => 'My Travel Experience in Nepal',
                'slug' => 'my-travel-experience-in-nepal',
                'description' => 'I had an amazing time exploring the beautiful cities of Nepal. From the historic streets of Kathmandu to the durbar square, canon(toop) of Gorkha, Nepal stole my heart.',
                'image' => 'nepal_travel.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Blog::insert($blogs);
    }
}
