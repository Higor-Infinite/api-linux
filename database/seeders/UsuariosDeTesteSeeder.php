<?php

namespace Database\Seeders;

use App\Enums\Perfil;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsuariosDeTesteSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@teste.com'],      
            [                                     
                'name' => 'Admin',
                'password' => 'zxc123',
            ],
        );
        $admin->syncRoles([Perfil::Admin->value]);

        $operador = User::firstOrCreate(
            ['email' => 'operador@teste.com'],
            [
                'name' => 'Operador',
                'password' => 'abc123',
            ],
        );
        $operador->syncRoles([Perfil::Operador->value]);
    }
}