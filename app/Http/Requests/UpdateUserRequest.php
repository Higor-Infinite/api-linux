<?php

namespace App\Http\Requests;

use App\Concerns\ProfileValidationRules;
use App\Enums\Perfil;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    use ProfileValidationRules;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->usuarioEditado());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $usuario = $this->usuarioEditado();

        $perfisPermitidos = $this->user()->is($usuario)
            ? [Perfil::Admin]
            : Perfil::cases();

        return [
            'name' => $this->nameRules(),
            'email' => $this->emailRules($usuario->id),
            'observacoes' => ['nullable', 'string', 'max:2000'],
            'password' => ['nullable', 'string', Password::default(), 'confirmed'],
            'perfil' => ['required', Rule::enum(Perfil::class)->only($perfisPermitidos)],
        ];
    }

    /**
     * Usuário que está sendo editado (vindo do parâmetro {usuario} da rota).
     */
    private function usuarioEditado(): User
    {
        return $this->route('usuario');
    }
}