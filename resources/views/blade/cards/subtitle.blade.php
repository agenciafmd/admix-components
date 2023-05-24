<p {{ $attributes->class(['card-subtitle']) }}>
    @if($slot->isEmpty())
        {{ $fallback }}
    @else
        {{ $slot }}
    @endif
</p>

@pushonce('styles')
    <style>
        .card-subtitle {
            margin-bottom: .5rem;
        }
    </style>
@endpushonce