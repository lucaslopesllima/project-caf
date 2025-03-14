@props(['disabled' => false])
<textarea rows="17" @disabled($disabled) {{ $attributes->merge(['class' => 'border border-gray-300 dark:border-white p-4 rounded-lg']) }}>
{{ $slot }}
</textarea>
