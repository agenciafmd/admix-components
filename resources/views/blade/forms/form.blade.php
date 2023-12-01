<form @isset($method) method="{{ $method !== 'GET' ? 'POST' : 'GET' }}" @endisset
@isset($action) action="{{ $action }}" @endisset
      @if(!isset($method) && !$attributes->whereStartsWith('wire:submit')->first()) wire:submit.prevent="submit" @endif
        {!! $hasFiles ? 'enctype="multipart/form-data"' : '' !!}
        {{ $attributes }}
>
    @isset($method)
        @csrf
        @method($method)
    @endisset

    {{ $slot }}
</form>