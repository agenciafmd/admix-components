@if($label)
    <x-form.label for="{{ Str::of($label)->studly() }}Plaintext">
        {{ Str::of($label)->ucfirst() }}
    </x-form.label>
@endif
<div class="form-control-plaintext" id="{{ Str::of($label)->studly() }}Plaintext">{{ $value }}</div>
