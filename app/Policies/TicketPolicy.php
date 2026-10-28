<?php

namespace App\Policies;

use App\Enums\Permissao;
use App\Models\Ticket;
use App\Models\User;

class TicketPolicy
{
    /**
     * Listar tickets.
     */
    public function viewAny(User $user): bool
    {
        return $this->podeGerenciarTickets($user);
    }

    /**
     * Ver um ticket.
     */
    public function view(User $user, Ticket $ticket): bool
    {
        return $this->podeGerenciarTickets($user);
    }

    /**
     * Criar tickets.
     */
    public function create(User $user): bool
    {
        return $this->podeGerenciarTickets($user);
    }

    /**
     * Editar título, descrição, prioridade e responsável.
     */
    public function update(User $user, Ticket $ticket): bool
    {
        return $this->podeGerenciarTickets($user);
    }

    /**
     * Alterar o status do ticket (ação granular, além do update).
     * Quais transições são válidas é decidido pela máquina de estados, não aqui.
     */
    public function alterarStatus(User $user, Ticket $ticket): bool
    {
        return $user->checkPermissionTo(Permissao::AlterarStatusTickets->value);
    }

    /**
     * Excluir um ticket.
     */
    public function delete(User $user, Ticket $ticket): bool
    {
        return $user->checkPermissionTo(Permissao::ExcluirTickets->value);
    }

    private function podeGerenciarTickets(User $user): bool
    {
        return $user->checkPermissionTo(Permissao::GerenciarTickets->value);
    }
}