<?php

namespace App\Concerns;

use App\Enums\Prioridade;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

trait TicketValidationRules
{
    /**
     * Regras dos campos que qualquer usuário com acesso ao ticket pode editar.
     *
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function ticketRules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string', 'max:5000'],
            'prioridade' => ['required', Rule::enum(Prioridade::class)],
            'responsavel_id' => ['required', 'integer', Rule::exists(User::class, 'id')],
        ];
    }
}