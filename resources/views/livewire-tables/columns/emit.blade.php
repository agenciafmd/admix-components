<button x-data="{}"
        x-on:click="{{ $path }}"
        {!! count($attributes) ? $column->arrayToAttributes($attributes) : '' !!}
>
    <svg xmlns="http://www.w3.org/2000/svg"
         class="icon d-sm-none d-block m-0"
         width="24"
         height="24"
         viewBox="0 0 24 24"
         stroke-width="2"
         stroke="currentColor"
         fill="none"
         stroke-linecap="round"
         stroke-linejoin="round"
    >
        <use xlink:href="{{ asset('vendor/admix/images/tabler-sprite.svg') }}#tabler-{{ $attributes['icon'] ?? 'click' }}"/>
    </svg>
    <span class="d-none d-sm-block">
        {{ $title }}
    </span>
</button>
