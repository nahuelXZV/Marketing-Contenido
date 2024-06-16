<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {/*  */
        $admin = Role::create(['name' => 'Administrador']);
        $gerente = Role::create(['name' => 'Gerente']);
        $empleado = Role::create(['name' => 'Empleado']);

        //Permisos
        Permission::create(['name' => 'administrador', 'description' => 'Permiso de administrador', 'type' => 'Administrativo'])->syncRoles($admin);
        Permission::create(['name' => 'user', 'description' => 'Gestionar usuarios', 'type' => 'Administrativo'])->syncRoles($admin);
        Permission::create(['name' => 'role', 'description' => 'Gestionar roles', 'type' => 'Administrativo'])->syncRoles($admin);
        Permission::create(['name' => 'company', 'description' => 'Gestionar empresa', 'type' => 'Administrativo'])->syncRoles($admin);
        Permission::create(['name' => 'customer', 'description' => 'Gestionar clientes', 'type' => 'Administrativo'])->syncRoles($admin);
        Permission::create(['name' => 'contract', 'description' => 'Gestionar contratos', 'type' => 'Administrativo'])->syncRoles($admin);
        Permission::create(['name' => 'campaign', 'description' => 'Gestionar campañas', 'type' => 'Administrativo'])->syncRoles($admin);
        Permission::create(['name' => 'publication', 'description' => 'Gestionar publicaciones', 'type' => 'Administrativo'])->syncRoles($admin);
        Permission::create(['name' => 'meta', 'description' => 'Gestionar publicaciones en meta', 'type' => 'Administrativo'])->syncRoles($admin);
    }
}
