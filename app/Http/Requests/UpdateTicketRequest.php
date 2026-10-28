<?php

namespace App\Http\Requests;

use App\Concerns\TicketValidationRules;
use App\Models\Ticket;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTicketRequest extends FormRequest
{
    use TicketValidationRules;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->ticketEditado());
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            ...$this->ticketRules(),
            'prioridade' => $this->prioridadeRules(),
            'status' => $this->statusRules(),
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'status.prohibited' => __('Você não tem permissão para alterar o status do ticket.'),
            'status.in' => __('Transição de status não permitida.'),
            'prioridade.prohibited' => __('Você não tem permissão para alterar a prioridade do ticket.'),
        ];
    }

    /**
     * Sem permissão: o campo é proibido.
     * Com permissão: aceita manter o status atual ou seguir para uma transição válida.
     *
     * @return array<int, ValidationRule|string>
     */
    private function statusRules(): array
    {
        $ticket = $this->ticketEditado();

        if ($this->user()->cannot('alterarStatus', $ticket)) {
            return ['prohibited'];
        }

        $permitidos = [
            $ticket->status->getValue(),
            ...$ticket->status->transitionableStates(),
        ];

        return ['required', 'string', Rule::in($permitidos)];
    }

    /**
     * Sem permissão: o campo é proibido (o select vem desabilitado e não é enviado).
     * Com permissão: as regras normais de prioridade.
     *
     * @return array<int, ValidationRule|string>
     */
    private function prioridadeRules(): array
    {
        if ($this->user()->cannot('alterarPrioridade', $this->ticketEditado())) {
            return ['prohibited'];
        }

        return $this->ticketRules()['prioridade'];
    }

    /**
     * Ticket que está sendo editado (vindo do parâmetro {ticket} da rota).
     */
    private function ticketEditado(): Ticket
    {
        return $this->route('ticket');
    }
}