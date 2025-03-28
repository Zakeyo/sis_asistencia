<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Super administrador', 'description' => 'Acceso completo al sistema']);

        Permission::create(['name' => 'asistencias', 'description' => 'Ver las asistencias'])->syncRoles([$admin]);
        Permission::create(['name' => 'asistencias.create', 'description' => 'Crear una asistencia'])->syncRoles([$admin]);
        // Permission::create(['name' => 'asistencias.create.index', 'description' => 'Crear una asistencia desde el inicio'])->syncRoles([$admin]);
        Permission::create(['name' => 'asistencias.edit', 'description' => 'Editar las asistencias'])->syncRoles([$admin]);
        Permission::create(['name' => 'asistencias.destroy', 'description' => 'Borrar las asistencias'])->syncRoles([$admin]);
        
        Permission::create(['name' => 'cargos', 'description' => 'Ver el personal'])->syncRoles([$admin]);
        Permission::create(['name' => 'cargos.create', 'description' => 'Crear un personal'])->syncRoles([$admin]);
        Permission::create(['name' => 'cargos.edit', 'description' => 'Editar el personal'])->syncRoles([$admin]);
        Permission::create(['name' => 'cargos.destroy', 'description' => 'Borrar el personal'])->syncRoles([$admin]);
        
        Permission::create(['name' => 'miembros', 'description' => 'Ver los miembros'])->syncRoles([$admin]);
        Permission::create(['name' => 'miembros.toggle', 'description' => 'Modificar el estado de los miembros'])->syncRoles([$admin]);
        Permission::create(['name' => 'miembros.create', 'description' => 'Crear un miembro'])->syncRoles([$admin]);
        Permission::create(['name' => 'miembros.edit', 'description' => 'Editar los miembros'])->syncRoles([$admin]);
        Permission::create(['name' => 'miembros.destroy', 'description' => 'Borrar los miembros'])->syncRoles([$admin]);
        
        Permission::create(['name' => 'rolesypermisos', 'description' => 'Ver los roles y permisos'])->syncRoles([$admin]);
        Permission::create(['name' => 'rolesypermisos.create', 'description' => 'Crear roles y permisos'])->syncRoles([$admin]);
        Permission::create(['name' => 'rolesypermisos.edit', 'description' => 'Editar los roles y permisos'])->syncRoles([$admin]);
        Permission::create(['name' => 'rolesypermisos.destroy', 'description' => 'Eliminar los roles y permisos'])->syncRoles([$admin]);
        
        Permission::create(['name' => 'usuarios', 'description' => 'Ver los usuarios'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios.habilitar', 'description' => 'Habilitar/Deshabilitar el acceso a un usuario'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios.create', 'description' => 'Crear un usuario'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios.edit', 'description' => 'Editar los usuarios'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios.destroy', 'description' => 'Borrar los usuarios'])->syncRoles([$admin]);

        Permission::create(['name' => 'reportes', 'description' => 'Ver los reportes'])->syncRoles([$admin]);
        Permission::create(['name' => 'reportes.asistencias', 'description' => 'Imprimir reportes de asistencias'])->syncRoles([$admin]);

        Permission::create(['name' => 'backup', 'description' => 'Realizar respaldo de la base de datos'])->syncRoles([$admin]);

        User::find(1)->assignRole($admin);
    }
}
