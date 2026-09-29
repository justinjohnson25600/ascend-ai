@props([
    'text' => '',
    'href' => null,
    'type' => 'button',
])

@if($href)
    <a href="{{ $href }}" {{ $attributes->class(['btn', 'btn-secondary']) }}>
        {{ $text }}
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class(['btn', 'btn-secondary']) }}>
        {{ $text }}
        {{ $slot }}
    </button>
@endif
