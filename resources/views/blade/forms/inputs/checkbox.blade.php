@php
    $classCollection = Str::of($attributes->get('class'))->explode(' ');
    $labelClass = $classCollection->filter(function (string $value, string $key) {
        return Str::of($value)->startsWith('form-switch');
    })->values();
    $inputClass = $classCollection->filter(function (string $value, string $key) {
        return !Str::of($value)->startsWith('form-switch');
    })->values();
@endphp
<label @class(['form-check', ...$labelClass->toArray()])>
    <input name="{{ $name }}"
           type="{{ $type }}"
           id="{{ $id }}"
           @if($value) value="{{ $value }}" @endif
           {{ $checked ? 'checked' : '' }}
           @if(!Str::of($name)->endsWith('[]') && !$attributes->whereStartsWith('wire:model')->first()) wire:model.lazy="{{ $name }}" @endif
            {{ $attributes->whereDoesntStartWith('class')->class(['form-check-input', ...$inputClass, 'is-invalid' => $errors->has($name)]) }}
            {{ $attributes }}
    />
    @if($label)
        <span class="form-check-label">
            {!! Str::of($label)->ucfirst() !!}
        </span>
    @endif
    @if($labelOn)
        <span class="form-check-label form-check-label-on">{!! Str::of($labelOn)->ucfirst() !!}</span>
    @endif
    @if($labelOff)
        <span class="form-check-label form-check-label-off">{!! Str::of($labelOff)->ucfirst() !!}</span>
    @endif
    <x-form.error field="{{ $name }}"/>
    @if($hint)
        <span class="form-check-description">
            {{ Str::of($hint)->stripTags()->squish() }}
        </span>
    @endif
</label>