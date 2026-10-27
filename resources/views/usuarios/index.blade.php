<x-layouts::app :title="__('Usuários')">
     <div class="flex items-center justify-between gap-4">
        <div>
            <flux:heading size="xl">{{ __('Usuários') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Lista de usuários.') }}</flux:text>
        </div>

        @can('create', App\Models\User::class)
            <flux:button variant="primary" icon="plus" :href="route('usuarios.create')">
                {{ __('Novo usuário') }}
            </flux:button>
        @endcan
    </div>

    @if (session('status'))
        <flux:callout variant="success" icon="check-circle" class="mt-6" :heading="session('status')" />
    @endif

    <flux:table class="mt-6">
        <flux:table.columns>
            <flux:table.column>{{ __('Nome') }}</flux:table.column>
            <flux:table.column>{{ __('E-mail') }}</flux:table.column>
            <flux:table.column>{{ __('Perfil') }}</flux:table.column>
            <flux:table.column></flux:table.column>
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
                     <flux:table.cell class="text-end">
                        <div class="flex items-center justify-end gap-2">
                            @can('update', $usuario)
                                <flux:button size="sm" variant="ghost" icon="pencil-square" :href="route('usuarios.edit', $usuario)">
                                    {{ __('Editar') }}
                                </flux:button>
                            @endcan

                            @can('delete', $usuario)
                                <form
                                    method="POST"
                                    action="{{ route('usuarios.destroy', $usuario) }}"
                                    onsubmit="return confirm({{ Js::from(__('Excluir o usuário :nome? Esta ação não pode ser desfeita.', ['nome' => $usuario->name])) }})"
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
                    <flux:table.cell colspan="4">{{ __('Nenhum usuário cadastrado.') }}</flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    <div class="mt-4">
        {{ $usuarios->links() }}
    </div>
</x-layouts::app>