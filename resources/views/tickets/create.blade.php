<x-layouts::app :title="__('Novo ticket')">
    <flux:heading size="xl">{{ __('Novo ticket') }}</flux:heading>
    <flux:text class="mt-2">{{ __('Todo ticket é criado com o status Aberto.') }}</flux:text>

    <form method="POST" action="{{ route('tickets.store') }}" class="mt-6 max-w-xl">
        @csrf

        @include('tickets.partials.form', ['ticket' => null])

        <div class="mt-6 flex items-center gap-4">
            <flux:button variant="primary" type="submit">{{ __('Salvar') }}</flux:button>
            <flux:button :href="route('tickets.index')" variant="ghost">{{ __('Cancelar') }}</flux:button>
        </div>
    </form>
</x-layouts::app>