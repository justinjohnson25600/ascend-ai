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
@endphp

<div {{ $attributes->class([$classes, $paddingClasses, 'card-hover' => $hover]) }}>
    {{ $slot }}
</div>
