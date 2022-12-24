<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use App\Models\Photo;
use App\Models\Profile;
use App\Models\Category;
use App\Models\CategoryPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
        User::factory(10)->create();
        Profile::factory(10)->create();
        Post::factory(10)->create();
        Category::factory(5)->create();
        CategoryPost::factory(10)->create();
        Photo::factory(4)->create();






        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
