<?php

namespace App\States\Ticket;

class Fechado extends TicketState
{
    public static $name = 'fechado';

    public function label(): string
    {
        return __('Fechado');
    }

    public function cor(): string
    {
        return 'zinc';
    }
}