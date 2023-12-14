@if($label)
    <x-form.label for="{{ $name }}">
        {{ Str::of($label)->ucfirst() }}
    </x-form.label>
@endif
<div @class([
        'drop-zone',
        '-mb-3',
        '-is-invalid' => ($errors->has("media.{$name}.*")),
    ])>
    <span class="drop-zone__prompt">
        Drop file here or click to upload
    </span>
    <input type="file"
           multiple
           name="{{ $name }}"
           @if($this->model->mediaAllowedExtensions($name)->count()) accept=".{{ $this->model->mediaAllowedExtensions($name)->join(',.') }}"
           @endif
           id="{{ $id }}"
           @if($disabled) disabled @endif
           @if(!$attributes->whereStartsWith('wire:model')->first()) wire:model.lazy="{{ "media.{$name}" }}" @endif
            {{ $attributes->class(['drop-zone__input', 'form-control', '-is-invalid' => ($errors->has("media.{$name}.*"))]) }}
            {{ $attributes }}
    />
</div>
<!--x-form.error field="media.{{ $name }}.*"/-->

@if($hint)
    <x-form.hint message="{{ $hint }}"/>
@else
    <x-form.hint>
        {!! str_replace('<br />', ' ∘ ', $this->model->mediaHint($name)) !!}
    </x-form.hint>
@endif

<?php
/*
- montar fluxo para o upload unico <-----
- montar fluxo para receber os meta dados
- montar barrinha de carregando
- testar o loading de upload
- thumb de extensão
*/
?>
{{--@dump($this->media[$name])--}}
{{--@dump($this->loadedMedia[$name])--}}
{{--@dump($this->selectedMedia)--}}

@if(count($this->selectedMedia))
    <a wire:click="$emit('deleteMedia', '{{ $name }}')">Remover selecionados</a>
@endif

<div class="row">
    @php
        $files = [];
        array_push($files, ...$this->media[$name], ...$this->loadedMedia[$name]);
    @endphp
    {{--    @dd($this->media[$name])--}}
    @foreach($files as $key => $file)
        @php
            $isTemporary = ($file instanceof \Livewire\TemporaryUploadedFile);
            if ($isTemporary) {
                try {
                    $tmpFile['original_url'] = $file->temporaryUrl();
                } catch (\Exception) {
                    $tmpFile['original_url'] = '';
                }

                $tmpFile['file_name'] = $file->getClientOriginalName();
                $tmpFile['size'] = $file->getSize();
                $tmpFile['uuid'] = $key;
//                $tmpFile['uuid'] = Str::orderedUuid()
//                    ->toString();
                $tmpFile['collection'] = $name;
                $tmpFile['is_temporary'] = true;

                $file = $tmpFile;
            }
            else {
                $file['is_temporary'] = false;
            }
        @endphp
        <div class="col-6 col-sm-4">
            <label class="form-imagecheck mb-2 @error("media.{$name}.{$key}") is-invalid @enderror">
                <input type="checkbox" wire:model.lazy="selectedMedia" value="{{ $file['uuid'] }}"
                       class="form-imagecheck-input">
                <span class="form-imagecheck-figure">
                    @if(Str::of($file['original_url'] ?: '')->pipe(fn ($string) => strtok($string, '?'))->lower()->endsWith(['jpeg', 'jpg', 'png', 'gif']))
                        <img src="{{ $file['original_url'] }}"
                             alt="{{ $file['file_name'] }}"
                             class="form-imagecheck-image">
                    @else
                        <span class="avatar avatar-xl form-imagecheck-image">
                            {{ Str::of($file['file_name'])->afterLast('.')->upper() }}
                        </span>
                    @endif
                    @if($file['is_temporary'])
                        colocar máscara de não subiu a img ainda
                    @endif
                </span>
            </label>
            {{--            @dump($this->loadedMeta)--}}
            <input type="text" wire:model.lazy="meta.{{ $name }}.{{ $file['uuid'] }}.title">
            <input type="text" wire:model.lazy="meta.{{ $name }}.{{ $file['uuid'] }}.description">
            <x-form.error field="media.{{ $name }}.{{ $key }}"/>

            <a wire:click="$emit('deleteMedia', '{{ $name }}', '{{ $file['uuid'] }}')">Remover</a>
        </div>
    @endforeach
</div>

{{--<div @class([--}}
{{--        'input-group',--}}
{{--        'input-group-flat',--}}
{{--        'is-invalid' => ($errors->has("media.{$name}"))--}}
{{--    ])>--}}
{{--    <input name="{{ $name }}[]"--}}
{{--           type="file"--}}
{{--           @if($this->model->mediaAllowedExtensions($name)->count()) accept=".{{ $this->model->mediaAllowedExtensions($name)->join(',.') }}"--}}
{{--           @endif--}}
{{--           id="{{ $id }}"--}}
{{--           @if($disabled) disabled @endif--}}
{{--           @if(!$attributes->whereStartsWith('wire:model')->first()) wire:model.lazy="{{ "media.{$name}" }}" @endif--}}
{{--            {{ $attributes->class(['form-control', 'is-invalid' => ($errors->has("media.{$name}"))]) }}--}}
{{--            {{ $attributes }}--}}
{{--    />--}}
{{--    @if($this->media[$name])--}}
{{--        @php--}}
{{--            if ($this->media[$name] instanceof \Livewire\TemporaryUploadedFile) {--}}
{{--                try {--}}
{{--                    $url = $this->media[$name]->temporaryUrl();--}}
{{--                } catch (\Exception) {--}}
{{--                    $url = '';--}}
{{--                }--}}

{{--                $preview = [--}}
{{--                    'uuid' => Str::orderedUuid()--}}
{{--                        ->toString(),--}}
{{--                    'collection' => $name,--}}
{{--                    'name' => $this->media[$name]->getClientOriginalName(),--}}
{{--                    'size' => $this->media[$name]->getSize(),--}}
{{--                    'url' => $url,--}}
{{--                ];--}}
{{--            }--}}
{{--            else {--}}
{{--                if ($this->media[$name] instanceof \Spatie\MediaLibrary\MediaCollections\Models\Media) {--}}
{{--                    $this->media[$name] = $this->media[$name]->toArray();--}}
{{--                }--}}

{{--                $preview = [--}}
{{--                    'uuid' => $this->media[$name]['uuid'],--}}
{{--                    'collection' => $name,--}}
{{--                    'name' => $this->media[$name]['file_name'],--}}
{{--                    'size' => $this->media[$name]['size'],--}}
{{--                    'url' => $this->media[$name]['original_url'],--}}
{{--                ];--}}
{{--            }--}}
{{--        @endphp--}}
{{--        --}}{{--        @dd($this->media[$name])--}}
{{--        --}}{{--         $tmp['name'] --}}
{{--        <span class="input-group-text">--}}
{{--            <a wire:click="$emit('deleteMedia', '{{ $preview['collection'] }}', '{{ $preview['uuid'] }}')"--}}
{{--               class="cursor-pointer link-secondary" data-bs-toggle="tooltip" data-bs-placement="top"--}}
{{--               aria-label="{{ __('Delete') }}" data-bs-original-title="{{ __('Delete') }}">--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"--}}
{{--                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"--}}
{{--                     stroke-linejoin="round">--}}
{{--                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>--}}
{{--                    <path d="M18 6l-12 12"></path>--}}
{{--                    <path d="M6 6l12 12"></path>--}}
{{--                </svg>--}}
{{--            </a>--}}
{{--            @if($preview['url'])--}}
{{--                <a href="{{ $preview['url'] }}" data-fslightbox="{{ $preview['collection'] }}"--}}
{{--                   class="link-secondary ms-2"--}}
{{--                   data-bs-toggle="tooltip" data-bs-placement="top"--}}
{{--                   aria-label="{{ __('View') }}" data-bs-original-title="{{ __('View') }}">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"--}}
{{--                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"--}}
{{--                         stroke-linejoin="round">--}}
{{--                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>--}}
{{--                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>--}}
{{--                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>--}}
{{--                    </svg>--}}
{{--                </a>--}}
{{--            @endif--}}
{{--        </span>--}}
{{--        <x-form.error field="media.{{ $name }}.*"/>--}}
{{--    @endif--}}
{{--</div>--}}

@pushonce('styles')
    <style>
        .drop-zone {
            height: 200px;
            padding: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-family: "Quicksand", sans-serif;
            font-weight: 500;
            font-size: 20px;
            cursor: pointer;
            color: #cccccc;
            border: 2px dashed var(--tblr-border-color);
            border-radius: var(--tblr-border-radius);
        }

        .drop-zone--over {
            border-style: solid;
        }

        .drop-zone__input {
            display: none;
        }

        .drop-zone.is-invalid, .is-invalid .form-imagecheck-figure {
            border-color: var(--tblr-danger);
        }

        .drop-zone__thumb {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            overflow: hidden;
            background-color: #cccccc;
            background-size: cover;
            position: relative;
        }

        .drop-zone__thumb::after {
            content: attr(data-label);
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 5px 0;
            color: #ffffff;
            background: rgba(0, 0, 0, 0.75);
            font-size: 14px;
            text-align: center;
        }
    </style>
@endpushonce