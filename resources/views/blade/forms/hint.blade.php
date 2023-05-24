<small {{ $attributes->class(['form-hint']) }}>
    @if($slot->isEmpty())
        {{ $fallback }}
    @else
        {{ $slot }}
    @endif
</small>