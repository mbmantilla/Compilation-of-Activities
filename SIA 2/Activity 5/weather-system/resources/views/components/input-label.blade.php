@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-blue-100 tracking-wide']) }}>
    {{ $value ?? $slot }}
</label>
