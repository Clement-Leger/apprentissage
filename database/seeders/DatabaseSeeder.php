<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\{Film, Category, Actor};
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

        // Category::factory()->count(10)->create();

        Actor::factory()->count(10)->create();

        $categories = [
            'Comédie',
            'Drame',
            'Action',
            'Fantastique',
            'Horreur',
            'Animation',
            'Espionnage',
            'Guerre',
            'Policier',
            'Pornographique',
        ];

        foreach($categories as $category) {
            Category::create(['name' => $category, 'slug' => str()->slug($category)]);
        };

        $ids = range(1, 10);
        Film::factory()->count(40)->create()->each(function ($film) use($ids) {
            shuffle($ids);
            $film->categories()->attach(array_slice($ids, 0, rand(1, 4)));
            shuffle($ids);
            $film->actors()->attach(array_slice($ids, 0, rand(1, 4)));
        });
    }
}