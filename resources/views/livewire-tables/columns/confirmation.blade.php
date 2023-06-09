<button x-data="{}"
        x-on:click="window.livewire.emitTo('modal.confirm', 'showConfirmationToDelete', '{{ $path }}')"
        {!! count($attributes) ? $column->arrayToAttributes($attributes) : '' !!}
>
    {{ $title }}
</button>
