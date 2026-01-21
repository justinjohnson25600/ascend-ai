@props([
    'text' => '',
    'href' => null,
    'type' => 'button',
])

@if($href)
    <a href="{{ $href }}" class="btn btn-primary {{ $attributes->class ?? '' }}">
        {{ $text }}
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" class="btn btn-primary {{ $attributes->class ?? '' }}">
        {{ $text }}
        {{ $slot }}
    </button>
@endif
