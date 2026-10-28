<x-layouts::app :title="__('Tickets')">
    <div class="flex items-center justify-between gap-4">
        <div>
            <flux:heading size="xl">{{ __('Tickets') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Lista de tickets.') }}</flux:text>
        </div>

        @can('create', App\Models\Ticket::class)
            <flux:button variant="primary" icon="plus" :href="route('tickets.create')">
                {{ __('Novo ticket') }}
            </flux:button>
        @endcan
    </div>

    @if (session('status'))
        <flux:callout variant="success" icon="check-circle" class="mt-6" :heading="session('status')" />
    @endif

    <flux:table class="mt-6">
        <flux:table.columns>
            <flux:table.column>{{ __('Título') }}</flux:table.column>
            <flux:table.column>{{ __('Status') }}</flux:table.column>
            <flux:table.column>{{ __('Prioridade') }}</flux:table.column>
            <flux:table.column>{{ __('Responsável') }}</flux:table.column>
            <flux:table.column></flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse ($tickets as $ticket)
                <flux:table.row :key="$ticket->id">
                    <flux:table.cell>{{ $ticket->titulo }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:badge size="sm" :color="$ticket->status->cor()">
                            {{ $ticket->status->label() }}
                        </flux:badge>
                    </flux:table.cell>
                    <flux:table.cell>{{ $ticket->prioridade->label() }}</flux:table.cell>
                    <flux:table.cell>{{ $ticket->responsavel->name }}</flux:table.cell>
                    <flux:table.cell class="text-end">
                        <div class="flex items-center justify-end gap-2">
                            @can('update', $ticket)
                                <flux:button size="sm" variant="ghost" icon="pencil-square" :href="route('tickets.edit', $ticket)">
                                    {{ __('Editar') }}
                                </flux:button>
                            @endcan

                            @can('delete', $ticket)
                                <form
                                    method="POST"
                                    action="{{ route('tickets.destroy', $ticket) }}"
                                    onsubmit="return confirm({{ Js::from(__('Excluir o ticket :titulo? Esta ação não pode ser desfeita.', ['titulo' => $ticket->titulo])) }})"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <flux:button size="sm" variant="danger" icon="trash" type="submit">
                                        {{ __('Excluir') }}
                                    </flux:button>
                                </form>
                            @endcan
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="5">{{ __('Nenhum ticket cadastrado.') }}</flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    <div class="mt-4">
        {{ $tickets->links() }}
    </div>
</x-layouts::app>