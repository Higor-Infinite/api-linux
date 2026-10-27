<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UserService
{
    /**
     * Cria um usuário e atribui o perfil informado.
     *
     * @param  array{name: string, email: string, observacoes?: string|null, password: string, perfil: string}  $dados
     */
    public function criar(array $dados): User
    {
        return DB::transaction(function () use ($dados) {
            $usuario = User::create(Arr::except($dados, ['perfil']));

            $usuario->syncRoles([$dados['perfil']]);

            return $usuario;
        });
    }

    /**
     * Atualiza os dados e o perfil de um usuário.
     * Senha em branco mantém a senha atual.
     *
     * @param  array{name: string, email: string, observacoes?: string|null, password?: string|null, perfil: string}  $dados
     */
    public function atualizar(User $usuario, array $dados): User
    {
        return DB::transaction(function () use ($usuario, $dados) {
            if (blank($dados['password'] ?? null)) {
                unset($dados['password']);
            }

            $usuario->update(Arr::except($dados, ['perfil']));

            $usuario->syncRoles([$dados['perfil']]);

            return $usuario;
        });
    }

     /**
     * Exclui um usuário.
     * A exclusão pelo model dispara o evento que remove os vínculos de perfis e permissões.
     */
    public function excluir(User $usuario): void
    {
        DB::transaction(function () use ($usuario) {
            $usuario->delete();
        });
    }
}