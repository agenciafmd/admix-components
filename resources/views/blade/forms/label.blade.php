<label for="{{ $for }}" {{ $attributes->class(['form-label']) }}>
    @if($slot->isEmpty())
        {{ $fallback }}
    @else
        {{ $slot }}
    @endif
</label>