@props(['disabled' => false])

<input  style="border: 1px solid  #cecece;" @disabled($disabled) {{ $attributes->merge(['class' => 'focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
