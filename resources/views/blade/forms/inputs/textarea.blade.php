@if($label)
    <x-form.label for="{{ $name }}">
        {{ Str::of($label)->ucfirst() }}
    </x-form.label>
@endif
<textarea name="{{ $name }}"
          id="{{ $id }}"
          rows="{{ $rows }}"
          @if($disabled) disabled @endif
          @if(!$value && !$attributes->whereStartsWith('wire:model')->first()) wire:model.lazy="{{ $name }}" @endif
        {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
        {{ $attributes }}>@if($value)
        {{ $value }}
    @endif</textarea>
<x-form.error field="{{ $name }}"/>
@if($hint)
    <x-form.hint message="{{ $hint }}"/>
@endif