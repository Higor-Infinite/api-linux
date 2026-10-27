<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class UserController extends Controller
{
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
}