@php
    $perfilAtual = old('perfil', $usuario?->getRoleNames()->first());
@endphp

<div class="flex flex-col gap-6">
    <flux:input
        name="name"
        :label="__('Nome')"
        :value="old('name', $usuario?->name)"
        required
        autofocus
    />

    <flux:input
        name="email"
        type="email"
        :label="__('E-mail')"
        :value="old('email', $usuario?->email)"
        required
    />

    <flux:select name="perfil" :label="__('Perfil')" required>
        @foreach ($perfis as $perfil)
            <flux:select.option :value="$perfil->value" :selected="$perfilAtual === $perfil->value">
                {{ $perfil->value }}
            </flux:select.option>
        @endforeach
    </flux:select>

    <flux:textarea name="observacoes" :label="__('Observações')" rows="4">{{ old('observacoes', $usuario?->observacoes) }}</flux:textarea>

    <flux:input
        name="password"
        type="password"
        :label="__('Senha')"
        :description="$usuario ? __('Deixe em branco para manter a senha atual.') : null"
        :required="$usuario === null"
        autocomplete="new-password"
    />

    <flux:input
        name="password_confirmation"
        type="password"
        :label="__('Confirmar senha')"
        :required="$usuario === null"
        autocomplete="new-password"
    />
</div>