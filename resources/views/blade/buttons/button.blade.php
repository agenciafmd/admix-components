<a href="{{ $href }}"
        {{ $attributes->class(['btn']) }}
        {{ $attributes }}>
    @if($slot->isEmpty())
        {{ $fallback }}
    @else
        {{ $slot }}
    @endif
</a>