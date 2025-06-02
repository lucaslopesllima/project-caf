<div>
    <x-input-label for="name" :value="__('Nome do Projeto')" />
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $project->name ?? '')" required autofocus autocomplete="name" />
    <x-input-error class="mt-2" :messages="$errors->get('name')" />
</div>

<div>
    <x-input-label for="date_started" :value="__('Data de Início')" />
    <x-text-input id="date_started" name="date_started" type="date" class="mt-1 block w-full" :value="old('date_started', $project->date_started ? $project->date_started->format('Y-m-d') : '')" required />
    <x-input-error class="mt-2" :messages="$errors->get('date_started')" />
</div>

<div>
    <x-input-label for="date_finished" :value="__('Data de Término (opcional)')" />
    <x-text-input id="date_finished" name="date_finished" type="date" class="mt-1 block w-full" :value="old('date_finished', $project->date_finished ? $project->date_finished->format('Y-m-d') : '')" />
    <x-input-error class="mt-2" :messages="$errors->get('date_finished')" />
</div>

<div>
    <x-input-label for="description" :value="__('Descrição')" />
    <textarea id="description" name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $project->description ?? '') }}</textarea>
    <x-input-error class="mt-2" :messages="$errors->get('description')" />
</div>

<div>
    <x-input-label for="responsible_type" :value="__('Tipo de Responsável')" />
    <select id="responsible_type" name="responsible_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="">Selecione o tipo de responsável</option>
        <option value="App\Models\User" {{ (old('responsible_type', $project->responsible_type ?? '') == 'App\Models\User') ? 'selected' : '' }}>Usuário</option>
        <option value="App\Models\Person" {{ (old('responsible_type', $project->responsible_type ?? '') == 'App\Models\Person') ? 'selected' : '' }}>Pessoa</option>
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('responsible_type')" />
</div>

<div>
    <x-input-label for="responsible_id" :value="__('Responsável')" />
    <select id="responsible_id" name="responsible_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="">Selecione o responsável</option>
        <!-- Esta parte será preenchida via JavaScript com base na seleção do tipo de responsável -->
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('responsible_id')" />
</div>

<div>
    <x-input-label for="is_activated" :value="__('Status')" />
    <select id="is_activated" name="is_activated" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="1" {{ (old('is_activated', $project->is_activated ?? 1) == 1) ? 'selected' : '' }}>Ativo</option>
        <option value="0" {{ (old('is_activated', $project->is_activated ?? 1) == 0) ? 'selected' : '' }}>Inativo</option>
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('is_activated')" />
</div>

<div>
    <x-input-label for="people" :value="__('Participantes')" />
    <select id="people" name="people[]" multiple class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <!-- Esta parte será preenchida via JavaScript ou controller com a lista de pessoas -->
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('people')" />
</div>

<div>
    <x-input-label for="users" :value="__('Usuários')" />
    <select id="users" name="users[]" multiple class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <!-- Esta parte será preenchida via JavaScript ou controller com a lista de usuários -->
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('users')" />
</div>

<div class="flex items-center justify-center gap-4">
    <x-primary-button>{{ __('Salvar') }}</x-primary-button>
</div>