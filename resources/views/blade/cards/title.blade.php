<h3 {{ $attributes->class(['card-title']) }}>
    @if($slot->isEmpty())
        {{ $fallback }}
    @else
        {{ $slot }}
    @endif
</h3>