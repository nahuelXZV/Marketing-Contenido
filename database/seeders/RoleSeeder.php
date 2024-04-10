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
    {
        $admin = Role::create(['name' => 'Administrador']);
        $gerente = Role::create(['name' => 'Gerente']);
        $empleado = Role::create(['name' => 'Empleado']);

        //Permisos
        Permission::create(['name' => 'administrador', 'description' => 'Permiso de administrador', 'type' => 'Administrativo'])->syncRoles($admin);
        Permission::create(['name' => 'usuario.index', 'description' => 'Gestionar usuarios', 'type' => 'Administrativo'])->syncRoles($admin);
        Permission::create(['name' => 'roles.index', 'description' => 'Gestionar roles', 'type' => 'Administrativo'])->syncRoles($admin);
        Permission::create(['name' => 'company.index', 'description' => 'Gestionar empresa', 'type' => 'Administrativo'])->syncRoles($admin);
        Permission::create(['name' => 'customer.index', 'description' => 'Gestionar clientes', 'type' => 'Administrativo'])->syncRoles($admin);
        Permission::create(['name' => 'contract.index', 'description' => 'Gestionar contratos', 'type' => 'Administrativo'])->syncRoles($admin);
    }
}
