<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
     * Usuários responsáveis por tickets não podem ser excluídos: os tickets precisam ser reatribuídos antes.
     * A exclusão pelo model dispara o evento que remove os vínculos de perfis e permissões.
     */
    public function excluir(User $usuario): void
    {
        $quantidadeTickets = $usuario->tickets()->count();

        if ($quantidadeTickets > 0) {
            throw ValidationException::withMessages([
                'usuario' => __('O usuário :nome é responsável por :quantidade ticket(s). Reatribua-os antes de excluir.', [
                    'nome' => $usuario->name,
                    'quantidade' => $quantidadeTickets,
                ]),
            ]);
        }

        DB::transaction(function () use ($usuario) {
            $usuario->delete();
        });
    }
}