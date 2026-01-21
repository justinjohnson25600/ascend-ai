@props([
    'text' => '',
    'href' => null,
    'type' => 'button',
])

@if($href)
    <a href="{{ $href }}" class="btn btn-secondary {{ $attributes->class ?? '' }}">
        {{ $text }}
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" class="btn btn-secondary {{ $attributes->class ?? '' }}">
        {{ $text }}
        {{ $slot }}
    </button>
@endif
