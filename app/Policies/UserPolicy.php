<?php

namespace App\Policies;

use App\Enums\Permissao;
use App\Models\User;


class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->podeGerenciarUsuarios($user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $this->podeGerenciarUsuarios($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->podeGerenciarUsuarios($user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $this->podeGerenciarUsuarios($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $this->podeGerenciarUsuarios($user) && $user->isNot($model);
    }


    private function podeGerenciarUsuarios(User $user): bool
    {
        return $user->checkPermissionTo(Permissao::GerenciarUsuarios->value);
    }
}
