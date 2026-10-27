<?php

namespace App\Enums;

enum Prioridade: string
{
    case Baixa = 'baixa';
    case Media = 'media';
    case Alta = 'alta';
    case Urgente = 'urgente';

    /**
     * Texto exibido nas telas.
     */
    public function label(): string
    {
        return match ($this) {
            self::Baixa => __('Baixa'),
            self::Media => __('Média'),
            self::Alta => __('Alta'),
            self::Urgente => __('Urgente'),
        };
    }
}