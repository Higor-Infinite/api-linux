<?php

namespace App\States\Ticket;

class Aberto extends TicketState
{
    public static $name = 'aberto';

    public function label(): string
    {
        return __('Aberto');
    }

    public function cor(): string
    {
        return 'blue';
    }
}