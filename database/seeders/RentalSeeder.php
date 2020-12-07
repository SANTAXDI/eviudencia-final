<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Rental;
use Illuminate\Support\Facades\Hash;
class RentalSeeder extends Seeder
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
            $rental = new Rental();
            $rental->total = $faker->numberBetween($min = 1000, $max = 9000);
            $rental->status_id = 1;
            $rental->user_id = $faker->randomElement([1,2,3,4,5,6,7,8,9,10]);
            $rental->save();

        }
    }
}
