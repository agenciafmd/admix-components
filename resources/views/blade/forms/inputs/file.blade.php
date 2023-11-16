@if($label)
    <x-form.label for="{{ $name }}">
        {{ Str::of($label)->ucfirst() }}
    </x-form.label>
@endif
<div @class([
        'input-group',
        'input-group-flat',
        'is-invalid' => ($errors->has("media.{$name}"))
    ])>
    <input name="{{ $name }}"
           type="file"
           @if($this->model->mediaAllowedExtensions($name)->count()) accept=".{{ $this->model->mediaAllowedExtensions($name)->join(',.') }}"
           @endif
           id="{{ $id }}"
           @if($disabled) disabled @endif
           @if(!$attributes->whereStartsWith('wire:model')->first()) wire:model.lazy="{{ "media.{$name}" }}" @endif
            {{ $attributes->class(['form-control', 'is-invalid' => ($errors->has("media.{$name}"))]) }}
            {{ $attributes }}
    />
    @if($this->media[$name])
        @php
            if ($this->media[$name] instanceof \Livewire\TemporaryUploadedFile) {
                try {
                    $url = $this->media[$name]->temporaryUrl();
                } catch (\Exception) {
                    $url = '';
                }

                $preview = [
                    'uuid' => Str::orderedUuid()
                        ->toString(),
                    'collection' => $name,
                    'name' => $this->media[$name]->getClientOriginalName(),
                    'size' => $this->media[$name]->getSize(),
                    'url' => $url,
                ];
            }
            else {
                if ($this->media[$name] instanceof \Spatie\MediaLibrary\MediaCollections\Models\Media) {
                    $this->media[$name] = $this->media[$name]->toArray();
                }

                $preview = [
                    'uuid' => $this->media[$name]['uuid'],
                    'collection' => $name,
                    'name' => $this->media[$name]['file_name'],
                    'size' => $this->media[$name]['size'],
                    'url' => $this->media[$name]['original_url'],
                ];
            }
        @endphp
        {{--        @dd($this->media[$name])--}}
        {{--         $tmp['name'] --}}
        <span class="input-group-text">
            <a wire:click="$emit('deleteMedia', '{{ $preview['collection'] }}', '{{ $preview['uuid'] }}')"
               class="cursor-pointer link-secondary" data-bs-toggle="tooltip" data-bs-placement="top"
               aria-label="{{ __('Delete') }}" data-bs-original-title="{{ __('Delete') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                     stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M18 6l-12 12"></path>
                    <path d="M6 6l12 12"></path>
                </svg>
            </a>
            @if($preview['url'])
                <a href="{{ $preview['url'] }}" data-fslightbox="{{ $preview['collection'] }}"
                   class="link-secondary ms-2"
                   data-bs-toggle="tooltip" data-bs-placement="top"
                   aria-label="{{ __('View') }}" data-bs-original-title="{{ __('View') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                    </svg>
                </a>
            @endif
        </span>
        <x-form.error field="media.{{ $name }}"/>
    @endif
</div>
    @if($hint)
        <x-form.hint message="{{ $hint }}"/>
    @else
        <x-form.hint>
            {!! $this->model->mediaHint($name) !!}
        </x-form.hint>
    @endif

@pushonce('styles')
    <style>
        .is-invalid .input-group-text {
            border-color: var(--tblr-danger);
            border-top-right-radius: var(--tblr-border-radius) !important;
            border-bottom-right-radius: var(--tblr-border-radius) !important;
        }
    </style>
@endpushonce