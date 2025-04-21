<div>
    <x-input-label for="name" :value="__('Name')" />
    <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full" :value="old('nome', $pessoa->nome ?? '')" required autofocus autocomplete="name" />
    <x-input-error class="mt-2" :messages="$errors->get('name')" />
</div>
<div>
    <x-input-label for="name" :value="__('Age')" />
    <x-text-input id="age" name="idade" type="text" class="mt-1 block w-full" :value="old('idade', $pessoa->idade ?? '')" required autofocus autocomplete="age" />
    <x-input-error class="mt-2" :messages="$errors->get('age')" />
</div>

<div>
    <x-input-label for="name" :value="__('quantity children')" />
    <x-text-input id="children" name="quantidade_filhos" type="text" class="mt-1 block w-full" :value="old('quantidade_filhos', $pessoa->quantidade_filhos ?? '')" required autofocus autocomplete="age" />
    <x-input-error class="mt-2" :messages="$errors->get('children')" />
</div>

<div>
    <x-input-label for="name" :value="__('naturality')" />
    <x-text-input id="naturality" name="naturalidade" type="text" class="mt-1 block w-full" :value="old('naturalidade', $pessoa->naturalidade ?? '')" required autofocus autocomplete="age" />
    <x-input-error class="mt-2" :messages="$errors->get('naturality')" />
</div>

<div>
    <x-input-label for="name" :value="__('neighborhood')" />
    <x-text-input id="neighborhood" name="bairro" type="text" class="mt-1 block w-full" :value="old('bairro', $pessoa->bairro ?? '')" required autofocus autocomplete="age" />
    <x-input-error class="mt-2" :messages="$errors->get('neighborhood')" />
</div>

<div>
    <x-input-label for="name" :value="__('education')" />
    <x-text-input id="education" name="escolaridade" type="text" class="mt-1 block w-full" :value="old('escolaridade', $pessoa->escolaridade ?? '')" required autofocus autocomplete="age" />
    <x-input-error class="mt-2" :messages="$errors->get('education')" />
</div>

<div>
    <x-input-label for="cpf" :value="__('cpf')" />
    <x-text-input id="cpf" name="cpf" type="text" class="mt-1 block w-full" :value="old('cpf', $pessoa->cpf ?? '')" required autofocus autocomplete="age" />
    <x-input-error class="mt-2" :messages="$errors->get('education')" />
</div>

<div class="flex items-center justify-center gap-4">
    <x-primary-button>{{ __('Save') }}</x-primary-button>
</div>