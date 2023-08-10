@if($label)
    <x-form.label for="{{ $name }}">
        {{ Str::of($label)->ucfirst() }}
    </x-form.label>
@endif
<div class="input-group input-group-flat @error($name) is-invalid @enderror" x-data="{ isPassword: true }">
    <input name="{{ $name }}"
           :type="isPassword ? '{{ $type }}' : 'text'"
           id="{{ $id }}"
           @if($value) value="{{ $value }}" @endif
           @if(!$value && !$attributes->whereStartsWith('wire:model')->first()) wire:model.lazy="{{ $name }}" @endif
            {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
            {{ $attributes }}
    />
    <span class="input-group-text ps-0">
        <a href="#"
           @click="isPassword = !isPassword"
           :class="isPassword ? 'd-block' : 'd-none'"
           class="link-secondary"
           title="{{ __('Show password') }}"
           data-bs-toggle="tooltip">
            <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                 stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                 stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/>
                <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"/>
            </svg>
        </a>
        <a href="#"
           @click="isPassword = !isPassword"
           :class="!isPassword ? 'd-block' : 'd-none'"
           class="link-secondary"
           title="{{ __('Hide password') }}"
           data-bs-toggle="tooltip">
            <!-- Download SVG icon from http://tabler-icons.io/i/eye-off -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                 stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                 stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"></path>
                <path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87"></path>
                <path d="M3 3l18 18"></path>
            </svg>
        </a>
    </span>
    <x-form.error field="{{ $name }}"/>
    @if($hint)
        <x-form.hint message="{{ $hint }}"/>
    @endif
</div>

@pushonce('styles')
    <style>
        .is-invalid .input-group-text {
            border-color: var(--tblr-danger);
            border-top-right-radius: var(--tblr-border-radius)!important;
            border-bottom-right-radius: var(--tblr-border-radius)!important;
        }
    </style>
@endpushonce