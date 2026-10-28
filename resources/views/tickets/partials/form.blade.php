@php
    $prioridadeAtual = old('prioridade', $ticket?->prioridade->value);
    $responsavelAtual = (string) old('responsavel_id', $ticket?->responsavel_id);
@endphp

<div class="flex flex-col gap-6">
    <flux:input
        name="titulo"
        :label="__('Título')"
        :value="old('titulo', $ticket?->titulo)"
        required
        autofocus
    />

    <flux:textarea name="descricao" :label="__('Descrição')" rows="5" required>{{ old('descricao', $ticket?->descricao) }}</flux:textarea>

    <flux:select name="prioridade" :label="__('Prioridade')" :placeholder="__('Selecione...')" required>
        @foreach ($prioridades as $prioridade)
            <flux:select.option :value="$prioridade->value" :selected="$prioridadeAtual === $prioridade->value">
                {{ $prioridade->label() }}
            </flux:select.option>
        @endforeach
    </flux:select>

    <flux:select name="responsavel_id" :label="__('Responsável')" :placeholder="__('Selecione...')" required>
        @foreach ($responsaveis as $responsavel)
            <flux:select.option :value="$responsavel->id" :selected="$responsavelAtual === (string) $responsavel->id">
                {{ $responsavel->name }}
            </flux:select.option>
        @endforeach
    </flux:select>
</div>