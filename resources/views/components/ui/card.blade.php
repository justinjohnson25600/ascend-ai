@props([
    'variant' => 'default', // default, glass, elevated
    'hover' => false,
    'padding' => 'md', // sm, md, lg
])

@php
$classes = match($variant) {
    'glass' => 'card-glass',
    'elevated' => 'card shadow-xl shadow-black/20',
    default => 'card',
};

$paddingClasses = match($padding) {
    'sm' => 'p-4',
    'md' => 'p-6',
    'lg' => 'p-8',
    default => 'p-6',
};

$hoverClass = $hover ? 'card-hover' : '';
@endphp

<div class="{{ $classes }} {{ $paddingClasses }} {{ $hoverClass }} {{ $attributes->class ?? '' }}">
    {{ $slot }}
</div>
