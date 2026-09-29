@props([
    'text' => '',
    'href' => null,
    'type' => 'button',
])

@if($href)
    <a href="{{ $href }}" {{ $attributes->class(['btn', 'btn-primary']) }}>
        {{ $text }}
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class(['btn', 'btn-primary']) }}>
        {{ $text }}
        {{ $slot }}
    </button>
@endif
