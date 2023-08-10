@if($label)
    <x-form.label for="{{ $name }}">
        {{ Str::of($label)->ucfirst() }}
    </x-form.label>
@endif
<select name="{{ $name }}"
        id="{{ $id }}"
        @if($value) value="{{ $value }}" @endif
        @if(!$value && !$attributes->whereStartsWith('wire:model')->first()) wire:model.lazy="{{ $name }}" @endif
        {{ $attributes->class(['form-select', 'is-invalid' => $errors->has($name)]) }}
        {{ $attributes }}
>
    <option value="">{{ $placeholder ?: '-' }}</option>
    @foreach($options as $optionValue => $optionLabel)
        @if(is_array($optionLabel))
            <optgroup label="{{ $optionValue }}">
                @foreach($optionLabel as $optionGroupValue => $optionGroupLabel)
                    <option value="{{ $optionGroupValue }}"
                            @if($optionGroupValue === $value) selected @endif
                    >{{ $optionGroupLabel }}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{ $optionValue }}"
                    @if($optionValue === $value) selected @endif
            >{{ $optionLabel }}</option>
        @endif
    @endforeach
</select>
<x-form.error field="{{ $name }}"/>
@if($hint)
    <x-form.hint message="{{ $hint }}"/>
@endif