@props([
    'desktop',                          // landscape photo in public/images, shown from 1024px
    'mobile' => null,                   // portrait photo for smaller screens; without one, the desktop photo sits at the top of the section and fades out
    'width' => 1672,                    // desktop photo size
    'height' => 941,
    'mobileWidth' => 941,               // portrait photo size
    'mobileHeight' => 1672,
    'mobilePosition' => 'object-center', // which part of the photo to keep below 1024px, for example object-[70%_center]
])

{{-- A decorative photo behind a section, at 40% so the copy stays readable. The section needs "relative overflow-hidden" and its content "relative z-10". --}}
@if ($mobile)
    <picture class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <source media="(min-width: 1024px)" srcset="{{ asset('images/'.$desktop) }}" width="{{ $width }}" height="{{ $height }}">
        <img src="{{ asset('images/'.$mobile) }}" alt="" width="{{ $mobileWidth }}" height="{{ $mobileHeight }}" loading="lazy" decoding="async" class="w-full h-full object-cover {{ $mobilePosition }} lg:object-center opacity-40">
    </picture>
    <div class="absolute inset-0 bg-gradient-to-b from-navy-950/60 via-transparent to-navy-950/60 pointer-events-none" aria-hidden="true"></div>
@else
    <img src="{{ asset('images/'.$desktop) }}" alt="" width="{{ $width }}" height="{{ $height }}" loading="lazy" decoding="async" aria-hidden="true"
        class="photo-fade absolute inset-x-0 top-0 w-full h-[30rem] lg:h-full object-cover {{ $mobilePosition }} lg:object-center opacity-40 pointer-events-none">
    <div class="hidden lg:block absolute inset-0 bg-gradient-to-b from-navy-950/60 via-transparent to-navy-950/60 pointer-events-none" aria-hidden="true"></div>
@endif
