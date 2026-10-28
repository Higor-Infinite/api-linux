<x-layouts::app :title="__('Editar ticket')">
    <flux:heading size="xl">{{ __('Editar ticket') }}</flux:heading>
    <flux:text class="mt-2">#{{ $ticket->id }} · {{ $ticket->titulo }}</flux:text>

    <form method="POST" action="{{ route('tickets.update', $ticket) }}" class="mt-6 max-w-xl">
        @csrf
        @method('PUT')

        @include('tickets.partials.form', ['ticket' => $ticket])

        <div class="mt-6">
            @can('alterarStatus', $ticket)
                @php
                    $statusAtual = old('status', $ticket->status->getValue());
                @endphp

                <flux:select name="status" :label="__('Status')" required>
                    @foreach ($estados as $estado)
                        <flux:select.option :value="$estado->getValue()" :selected="$statusAtual === $estado->getValue()">
                            {{ $estado->label() }}
                        </flux:select.option>
                    @endforeach
                </flux:select>
            @else
                <flux:text>{{ __('Status') }}</flux:text>
                <flux:badge class="mt-2" :color="$ticket->status->cor()">
                    {{ $ticket->status->label() }}
                </flux:badge>
                <flux:text class="mt-2 text-sm">
                    {{ __('Somente administradores podem alterar o status.') }}
                </flux:text>
            @endcan
        </div>

        <div class="mt-6 flex items-center gap-4">
            <flux:button variant="primary" type="submit">{{ __('Salvar alterações') }}</flux:button>
            <flux:button :href="route('tickets.index')" variant="ghost">{{ __('Cancelar') }}</flux:button>
        </div>
    </form>
</x-layouts::app>