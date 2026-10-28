@php
    $prioridadeAtual = old('prioridade', $ticket?->prioridade->value);
    $responsavelAtual = (string) old('responsavel_id', $ticket?->responsavel_id);

    // Na criação ($ticket null) quem chega aqui já pode criar; na edição, pergunta à Policy.
    $usuario = auth()->user();
    $podeAlterarNome = $ticket === null || $usuario->can('tickets.alterar-nome', $ticket);
    $podeAlterarPrioridade = $ticket === null || $usuario->can('tickets.alterar-prioridade', $ticket);
    $podeAlterarResponsavel = $ticket === null || $usuario->can('tickets.alterar-responsavel', $ticket);
@endphp

<div class="flex flex-col gap-6">
     @if ($podeAlterarNome)
        <flux:input
            name="titulo"
            :label="__('Título')"
            :value="old('titulo', $ticket?->titulo)"
            required
            autofocus
        />
    @else
        <flux:input
            :label="__('Título')"
            :value="$ticket->titulo"
            :description="__('Você não tem permissão para alterar o título.')"
            disabled
        />
    @endif

    <flux:textarea name="descricao" :label="__('Descrição')" rows="5" required>{{ old('descricao', $ticket?->descricao) }}</flux:textarea>

        @if ($podeAlterarPrioridade)
        <flux:select name="prioridade" :label="__('Prioridade')" :placeholder="__('Selecione...')" required>
            @foreach ($prioridades as $prioridade)
                <flux:select.option :value="$prioridade->value" :selected="$prioridadeAtual === $prioridade->value">
                    {{ $prioridade->label() }}
                </flux:select.option>
            @endforeach
        </flux:select>
        @else
        <flux:select
            :label="__('Prioridade')"
            :description="__('Você não tem permissão para alterar a prioridade.')"
            disabled
        >
            <flux:select.option selected>{{ $ticket->prioridade->label() }}</flux:select.option>
        </flux:select>
        @endif

        @if ($podeAlterarResponsavel)
        <flux:select name="responsavel_id" :label="__('Responsável')" :placeholder="__('Selecione...')" required>
            @foreach ($responsaveis as $responsavel)
                <flux:select.option :value="$responsavel->id" :selected="$responsavelAtual === (string) $responsavel->id">
                    {{ $responsavel->name }}
                </flux:select.option>
            @endforeach
        </flux:select>
    @else
        <flux:select
            :label="__('Responsável')"
            :description="__('Você não tem permissão para alterar o responsável.')"
            disabled
        >
            <flux:select.option selected>{{ $ticket->responsavel->name }}</flux:select.option>
        </flux:select>
    @endif
</div>