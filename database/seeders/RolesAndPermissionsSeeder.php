<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Limpar cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ------------------------
        // 1. Criar permissões
        // ------------------------
        Permission::firstOrCreate(['name' => 'users']);             // listar usuarios
        Permission::firstOrCreate(['name' => 'users.show']);        // ver usuario especifico 
        Permission::firstOrCreate(['name' => 'users.export']);      // exportar .csv usuarios 
        Permission::firstOrCreate(['name' => 'profile']);           // meu perfil
        Permission::firstOrCreate(['name' => 'profile.edit']);      // editar perfil
        Permission::firstOrCreate(['name' => 'profile.email']);     // editar email
        Permission::firstOrCreate(['name' => 'profile.password']);  // editar senha
        Permission::firstOrCreate(['name' => 'profile.delete']);    // excluir conta

        //Administrador
        Permission::firstOrCreate(['name' => 'admin']);
        Permission::firstOrCreate(['name' => 'admin.dashboard']);
        Permission::firstOrCreate(['name' => 'logs.show']);         // listar logs
        Permission::firstOrCreate(['name' => 'logs.export']);       // exportar .csv logs

        Permission::firstOrCreate(['name' => 'roles']);         // listar logs
        Permission::firstOrCreate(['name' => 'roles.management']);       // exportar .csv logs

        // ------------------------
        // 2. Criar roles
        // ------------------------
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user = Role::firstOrCreate(['name' => 'user']);


        // ------------------------
        // 3. Dar permissões
        // ------------------------

        $admin->givePermissionTo(Permission::all());
        $user->givePermissionTo([
                                'users',
                                'users.show',
                                'users.export',
                                'profile',
                                'profile.edit',
                                'profile.email',
                                'profile.password',
                                'profile.delete',
                            ]);
    }
}