@props([
    'type' => '',
    'header' => null,
    'footer' => null,
])
<div x-data="{
        show: @entangle($attributes->wire('model')).defer
     }"
     x-show="show"
     x-on:keydown.escape.window="show = false">
    <div x-on:click="show = false"
         x-bind:class="{'show': show}"
         x-bind:aria-hidden="show ? false : true"
         x-bind:style="{'display': show ? 'block' : 'none'}"
         class="modal modal-blur fade" id="baseModal" tabindex="-1" aria-labelledby="baseModalLabel">
        <div class="modal-dialog modal-dialog-centered @if($type) modal-sm @endif" role="document">
            <div class="modal-content">
                @if($type)
                    <button x-on:click="show = false"
                            type="button"
                            class="btn-close"
                            aria-label="{{ __('Close') }}"></button>
                    <div class="modal-status bg-{{ $type }}"></div>
                @else
                    <div class="modal-header">
                        @if($header)
                            {{ $header }}
                        @else
                            <h5 class="modal-title">{{ $title }}</h5>
                            <button x-on:click="show = false"
                                    type="button"
                                    class="btn-close"
                                    aria-label="{{ __('Close') }}"></button>
                        @endif
                    </div>
                @endif

                <div @class([
                        'modal-body',
                        'text-center' => $type,
                        'py-4' => $type,
                    ])>
                    @if($type === 'danger')
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z"></path>
                            <path d="M12 9v4"></path>
                            <path d="M12 17h.01"></path>
                        </svg>
                    @endif
                    @if($type === 'success')
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-green icon-lg" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                            <path d="M9 12l2 2l4 -4"></path>
                        </svg>
                    @endif
                    @if($type)
                        <h3>{{ $title }}</h3>
                        <div class="text-muted">
                            {!! $slot !!}
                        </div>
                    @else
                            {!! $slot !!}
                    @endif
                </div>

                @if($footer)
                    {{ $footer }}
                @else
                        @if($action)
                            <div class="modal-footer">
                                @if($type)
                                    <div class="w-100">
                                        <div class="row">
                                            <div class="col">
                                                <button x-on:click="show = false" class="btn w-100">
                                                    {{ __('No') }}
                                                </button>
                                            </div>
                                            <div class="col">
                                                <button wire:click="{{ $action }}" class="btn btn-{{ $type }} w-100">
                                                    {{ __('Yes') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <button x-on:click="show = false" class="btn me-auto">{{ __('No') }}</button>
                                    <button wire:click="{{ $action }}" class="btn btn-primary">{{ __('Yes') }}</button>
                                @endif
                            </div>
                        @endif
                @endif
            </div>
        </div>
    </div>
</div>
