<?php

namespace App\Enums;

enum Permissao: string
{
    case GerenciarUsuarios = 'usuarios.gerenciar';
    case GerenciarTickets = 'tickets.gerenciar';
    case AlterarStatusTickets = 'tickets.alterar-status';
    case ExcluirTickets = 'tickets.excluir';
}