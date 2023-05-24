@error($field, $bag)
<div {{ $attributes->class(['invalid-feedback']) }}>
    @if ($slot->isEmpty())
        {{ $message }}
    @else
        {{ $slot }}
    @endif
</div>
@enderror