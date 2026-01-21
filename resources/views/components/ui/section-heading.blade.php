@props([
    'title' => '',
    'subtitle' => null,
    'alignment' => 'center', // left, center
    'size' => 'default', // default, large
])

@php
$alignmentClasses = $alignment === 'center' ? 'text-center mx-auto' : 'text-left';
$sizeClasses = $size === 'large' ? 'text-display-lg md:text-display-xl' : 'text-display-md md:text-display-lg';
@endphp

<div class="{{ $alignmentClasses }} mb-12">
    <h2 class="{{ $sizeClasses }} font-bold gradient-text">
        {{ $title }}
    </h2>
    @if($subtitle)
        <p class="section-subtitle {{ $alignment === 'center' ? 'mx-auto' : '' }}">
            {{ $subtitle }}
        </p>
    @endif
</div>
