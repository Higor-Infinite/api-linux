<?php

namespace Database\Seeders;

use App\Enums\Perfil;
use App\Enums\Permissao;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PerfisEPermissoesSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        
        $gerenciarUsuarios = Permission::firstOrCreate([
            'name' => Permissao::GerenciarUsuarios->value,
        ]);

        
        $admin = Role::firstOrCreate(['name' => Perfil::Admin->value]);
        Role::firstOrCreate(['name' => Perfil::Operador->value]);

       
        $admin->syncPermissions([$gerenciarUsuarios]);
        
    }
}