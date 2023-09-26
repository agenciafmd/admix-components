@if($label)
    <x-form.label for="{{ $name }}">
        {{ Str::of($label)->ucfirst() }}
    </x-form.label>
@endif
<input name="{{ $name }}"
       type="{{ $type }}"
       id="{{ $id }}"
       @if($value) value="{{ $value }}" @endif
       @if($disabled) disabled @endif
       @if(!$value && !$attributes->whereStartsWith('wire:model')->first()) wire:model.lazy="{{ $name }}" @endif
        {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
        {{ $attributes }}
/>
<x-form.error field="{{ $name }}"/>
@if($hint)
    <x-form.hint message="{{ $hint }}"/>
@endif