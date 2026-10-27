<x-layouts::app :title="__('Novo usuário')">
    <flux:heading size="xl">{{ __('Novo usuário') }}</flux:heading>

    <form method="POST" action="{{ route('usuarios.store') }}" class="mt-6 max-w-xl">
        @csrf

        @include('usuarios.partials.form', ['usuario' => null])

        <div class="mt-6 flex items-center gap-4">
            <flux:button variant="primary" type="submit">{{ __('Salvar') }}</flux:button>
            <flux:button :href="route('usuarios.index')" variant="ghost">{{ __('Cancelar') }}</flux:button>
        </div>
    </form>
</x-layouts::app>