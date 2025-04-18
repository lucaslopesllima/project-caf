<div>
    <x-input-label for="texto" :value="__('Question text')" />
    <x-text-area id="texto" name="texto"  class="mt-1 block w-full" >{{old('texto', $perguntum->texto ?? '')}}</x-text-area>
    <x-input-error class="mt-2" :messages="$errors->get('texto')" />
    <div class="flex items-center justify-center gap-4">
    <x-primary-button class="mt-3">{{ __('Save') }}</x-primary-button>
</div>
