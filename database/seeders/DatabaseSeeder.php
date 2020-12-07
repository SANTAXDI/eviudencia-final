<?php

namespace Database\Seeders;

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
        $this->call(TypeStatusSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RentalSeeder::class);
        $this->call(MovieSeeder::class);
        $this->call(CategorySeeder::class);

        // \App\Models\User::factory(10)->create();
    }
}
