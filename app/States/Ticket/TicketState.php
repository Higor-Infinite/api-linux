<?php

namespace App\States\Ticket;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

/**
 * @extends State<\App\Models\Ticket>
 */
abstract class TicketState extends State
{
    /**
     * Texto exibido nas telas.
     */
    abstract public function label(): string;

    /**
     * Cor do badge (Flux).
     */
    abstract public function cor(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Aberto::class)
            ->allowTransition(Aberto::class, EmAndamento::class)
            ->allowTransition(EmAndamento::class, Resolvido::class)
            ->allowTransition(Resolvido::class, Fechado::class);
    }
}