<?php

namespace App\States\Ticket;

class Resolvido extends TicketState
{
    public static $name = 'resolvido';

    public function label(): string
    {
        return __('Resolvido');
    }

    public function cor(): string
    {
        return 'green';
    }
}
