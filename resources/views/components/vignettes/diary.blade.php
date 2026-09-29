@php
    $s = fn (int $n): string => "at($n) ? 'vig-on' : 'vig-off'";
    $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
    $times = ['09:00', '10:00', '14:00', '16:00'];
    // Slots already booked before the story starts: [day index, time index]
    $booked = [[0, 0], [0, 2], [1, 1], [1, 3], [2, 0], [3, 3], [4, 2]];
@endphp
<x-vignettes.frame
    name="diary"
    title="Diary"
    :steps="5"
    label="a customer books online, gets a reminder the day before, moves another appointment themselves, and a missed appointment is followed up."
>
    <div class="grid grid-cols-[2.75rem_repeat(5,minmax(0,1fr))] gap-1 text-[10px]">
        <span></span>
        @foreach ($days as $day)
            <span class="text-center text-gray-500 pb-1">{{ $day }}</span>
        @endforeach

        @foreach ($times as $t => $time)
            <span class="text-gray-500 flex items-center">{{ $time }}</span>
            @foreach ($days as $d => $day)
                <div class="relative h-8 rounded-md bg-white/[0.03] border border-white/5">
                    @if (in_array([$d, $t], $booked, true))
                        <div class="absolute inset-0.5 rounded bg-slate-600/80"></div>
                    @endif

                    @if ($d === 2 && $t === 1)
                        <div class="vig-item absolute inset-0.5 rounded bg-accent-500 text-white flex items-center justify-center font-medium" :class="{!! $s(1) !!}">New</div>
                    @endif

                    @if ($d === 3 && $t === 2)
                        <div class="absolute inset-0.5 rounded bg-slate-600/80 transition-opacity duration-500" :class="at(3) ? 'opacity-0' : 'opacity-100'"></div>
                    @endif

                    @if ($d === 4 && $t === 0)
                        <div class="vig-item absolute inset-0.5 rounded bg-purple-500/80 text-white flex items-center justify-center font-medium" :class="{!! $s(3) !!}">Moved</div>
                    @endif
                </div>
            @endforeach
        @endforeach
    </div>

    <div class="mt-4 space-y-2">
        <div class="vig-item" :class="{!! $s(2) !!}"><span class="vig-chip">Reminder sent: see you tomorrow at 10:00</span></div>
        <div class="vig-item" :class="{!! $s(4) !!}"><span class="vig-chip">Moved by the customer, Thursday to Friday</span></div>
        <div class="vig-item" :class="{!! $s(5) !!}"><span class="vig-chip-warn">Missed appointment: rebooking link sent</span></div>
    </div>
</x-vignettes.frame>
