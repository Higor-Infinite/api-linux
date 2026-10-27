<?php

namespace App\States\Ticket;

class EmAndamento extends TicketState
{
    public static $name = 'em_andamento';

    public function label(): string
    {
        return __('Em andamento');
    }

    public function cor(): string
    {
        return 'amber';
    }
}