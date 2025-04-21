<div>
    <x-input-label for="name" :value="__('Name')" />
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
        :value="old('name', $user->name ?? '')" required autofocus autocomplete="name" />
    <x-input-error class="mt-2" :messages="$errors->get('name')" />
</div>
<div>
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
        :value="old('email', $user->email ?? '')" required autocomplete="username" />
    <x-input-error class="mt-2" :messages="$errors->get('email')" />
</div>
<div>
    <label for="role">
        Função
        <x-text-input id="role" name="role" type="text" class="mt-1 block w-full"
            :value="old('role', $user->role ?? '')" required autocomplete="função" />
        <x-input-error class="mt-2" :messages="$errors->get('role')" />
    </label>
</div>
