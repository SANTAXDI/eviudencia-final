<?php

namespace Database\Seeders;

use App\Models\TypeStatus;
use Illuminate\Database\Seeder;

class TypeStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayData=[
         [ 'name' => 'General'],
         [ 'name' => 'Peliculas'],
         [ 'name' => 'Usuarios']
        ];
        
        foreach ($arrayData as $data) {
            $typeStatus = new TypeStatus();
            $typeStatus->name = $data['name'];
            $typeStatus->save();
        }
    }
}
