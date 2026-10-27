<x-layouts::app :title="__('Editar usuário')">
    <flux:heading size="xl">{{ __('Editar usuário') }}</flux:heading>
    <flux:text class="mt-2">{{ $usuario->email }}</flux:text>

    <form method="POST" action="{{ route('usuarios.update', $usuario) }}" class="mt-6 max-w-xl">
        @csrf
        @method('PUT')

        @include('usuarios.partials.form', ['usuario' => $usuario])

        <div class="mt-6 flex items-center gap-4">
            <flux:button variant="primary" type="submit">{{ __('Salvar alterações') }}</flux:button>
            <flux:button :href="route('usuarios.index')" variant="ghost">{{ __('Cancelar') }}</flux:button>
        </div>
    </form>
</x-layouts::app>