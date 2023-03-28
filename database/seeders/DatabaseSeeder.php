<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\{Film, Category};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Category::factory()
        // ->has(Film::factory()->count(4))
        // ->count(10)
        // ->create();

        Category::factory()->count(10)->create();
        
        $ids = range(1, 10);
        Film::factory()->count(40)->create()->each(function ($film) use($ids) {
            shuffle($ids);
            $film->categories()->attach(array_slice($ids, 0, rand(1, 4)));
        });
    }
}
