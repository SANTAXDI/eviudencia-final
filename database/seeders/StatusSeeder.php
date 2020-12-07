<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayData=[
            [ 'name' => 'Activo', 'type_status_id' => 1],
            [ 'name' => 'Inactivo', 'type_status_id' => 1],
            [ 'name' => 'Pendiente', 'type_status_id' => 2],
            [ 'name' => 'Entregado', 'type_status_id' => 2],
            [ 'name' => 'Bloqueado', 'type_status_id' => 3]

           ];
           
           foreach ($arrayData as $data) {
               $status = new Status();
               $status->name = $data['name'];
               $status->type_status_id = $data['type_status_id'];
               $status->save();
           }
    }
}
