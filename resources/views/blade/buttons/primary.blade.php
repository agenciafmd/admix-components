<button {{ $attributes->class(['btn', 'btn-primary']) }}
        {{ $attributes }}>
    @if($slot->isEmpty())
        {{ $fallback }}
    @else
        {{ $slot }}
    @endif
</button>