<x-layouts::app :title="__('Usuários')">
    <flux:heading size="xl">{{ __('Usuários') }}</flux:heading>

    <flux:text class="mt-2">
        {{ __('Lista de usuários.') }}
    </flux:text>

    <flux:table class="mt-6">
        <flux:table.columns>
            <flux:table.column>{{ __('Nome') }}</flux:table.column>
            <flux:table.column>{{ __('E-mail') }}</flux:table.column>
            <flux:table.column>{{ __('Perfil') }}</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse ($usuarios as $usuario)
                <flux:table.row :key="$usuario->id">
                    <flux:table.cell>{{ $usuario->name }}</flux:table.cell>
                    <flux:table.cell>{{ $usuario->email }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:badge size="sm">
                            {{ $usuario->getRoleNames()->implode(', ') ?: __('Sem perfil') }}
                        </flux:badge>
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="3">{{ __('Nenhum usuário cadastrado.') }}</flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    <div class="mt-4">
        {{ $usuarios->links() }}
    </div>
</x-layouts::app>