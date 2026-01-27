@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-blue-800 mb-2 uppercase tracking-wide']) }}>
    {{ $value ?? $slot }}
</label>
