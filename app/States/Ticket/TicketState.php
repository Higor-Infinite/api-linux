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
        $estados = [
            Aberto::class,
            EmAndamento::class,
            Resolvido::class,
            Fechado::class,
        ];

        $config = parent::config()->default(Aberto::class);

        foreach ($estados as $de) {
            foreach ($estados as $para) {
                if ($de !== $para) {
                    $config->allowTransition($de, $para);
                }
            }
        }

        return $config;
    }
}