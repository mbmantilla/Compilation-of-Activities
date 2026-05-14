@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-pink-300 font-medium space-y-1 bg-pink-500/20 px-3 py-1 rounded-lg border border-pink-500/30 mt-2']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
