<button x-data="{}"
        x-on:click="{{ $path }}"
        {!! count($attributes) ? $column->arrayToAttributes($attributes) : '' !!}
>
    {{ $title }}
</button>
