<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayData = [
            ['name' => 'Administrador', 'status_id' => 1],
            ['name' => 'Cliente', 'status_id' => 1],
            ['name' => 'Empleado', 'status_id' => 1]
        ];

        foreach ($arrayData as $data) {
            $role = new Role();
            $role->name = $data['name'];
            $role->status_id = $data['status_id'];
            $role->save();
        }
    }
}
