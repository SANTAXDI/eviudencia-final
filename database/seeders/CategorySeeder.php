<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayData=[
            [ 'name' => 'Accion', 'status_id' => 1],
            [ 'name' => 'Suspenso', 'status_id' => 1],
            [ 'name' => 'Terror', 'status_id' => 1],
            [ 'name' => 'Comedia', 'status_id' => 1],
            [ 'name' => 'Fantasia', 'status_id' => 1],
            [ 'name' => 'Aventura', 'status_id' => 1],
            [ 'name' => 'Ciencia Ficcion', 'status_id' => 1],
            [ 'name' => 'Anime', 'status_id' => 1],
            [ 'name' => 'Heroes', 'status_id' => 1],
            [ 'name' => 'Deporte', 'status_id' => 1]
           ];
           
           foreach ($arrayData as $data) {
               $category = new Category();
               $category->name = $data['name'];
               $category->status_id = $data['status_id'];
               $category->save();
           }
    }
}
