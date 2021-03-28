<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Star;
use App\Models\Studio;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $tags_batch_one = Tag::factory()->count(5)->create();
        $tags_batch_two = Tag::factory()->count(5)->create();
        $stars_batch_one = Star::factory()->count(1)->create();
        $stars_batch_two = Star::factory()->count(2)->create();

        // studio 1
        Studio::factory()->has(
            Movie::factory()
                ->hasAttached($stars_batch_one)
                ->hasAttached($tags_batch_one)
                ->count(2)
        )->create();

        // studio 2
        Studio::factory()->has(
            Movie::factory()
                ->hasAttached($stars_batch_two)
                ->hasAttached($tags_batch_two)
                ->count(2)
        )->create();

        // studio 3
        Studio::factory()->has(
            Movie::factory()
                ->hasAttached($stars_batch_one)
                ->hasAttached($tags_batch_one)
                ->count(4)
        )->create();
    }
}
