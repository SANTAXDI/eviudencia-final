<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Movie;
use Illuminate\Support\Facades\Hash;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i<10; $i++) {
            $movie = new Movie();
            $movie->name = $faker->word;
            $movie->description = $faker->text($maxNbChars = 200);
            $movie->user_id = $faker->randomElement([1,2,3,4,5,6,7,8,9,10]);
            $movie->status_id = 1;
            $movie->save();
        }
    }
}
