<?php

namespace App\Http\Controllers;

use App\Enums\Perfil;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {}

    /**
     * Lista os usuários cadastrados.
     */
    public function index(): View
    {
        Gate::authorize('viewAny', User::class);

        $usuarios = User::query()
            ->with('roles')
            ->orderBy('name')
            ->paginate(15);

        return view('usuarios.index', [
            'usuarios' => $usuarios,
        ]);
    }

    /**
     * Exibe o formulário de criação.
     */
    public function create(): View
    {
        Gate::authorize('create', User::class);

        return view('usuarios.create', [
            'perfis' => Perfil::cases(),
        ]);
    }

    /**
     * Grava um novo usuário.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->userService->criar($request->validated());

        return redirect()
            ->route('usuarios.index')
            ->with('status', __('Usuário criado com sucesso.'));
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(User $usuario): View
    {
        Gate::authorize('update', $usuario);

        return view('usuarios.edit', [
            'usuario' => $usuario,
            'perfis' => Perfil::cases(),
        ]);
    }

    /**
     * Grava as alterações de um usuário.
     */
    public function update(UpdateUserRequest $request, User $usuario): RedirectResponse
    {
        $this->userService->atualizar($usuario, $request->validated());

        return redirect()
            ->route('usuarios.index')
            ->with('status', __('Usuário atualizado com sucesso.'));
    }

     /**
     * Exclui um usuário.
     */
    public function destroy(User $usuario): RedirectResponse
    {
        Gate::authorize('delete', $usuario);

        $this->userService->excluir($usuario);

        return redirect()
            ->route('usuarios.index')
            ->with('status', __('Usuário excluído com sucesso.'));
    }
}