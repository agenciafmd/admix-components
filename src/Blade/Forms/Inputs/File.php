<?php

namespace Agenciafmd\Components\Blade\Forms\Inputs;

use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Livewire\TemporaryUploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class File extends Component
{
    public string $name;
    public string $id;
    public string $label;
    public string $hint;
    public bool $disabled;
    public array $media;
    public mixed $tmp;

    public function __construct(
        string  $name,
        string  $id = null,
        ?string $label = '',
        ?string $hint = '',
        bool    $disabled = false,
        array   $media = [],
    )
    {
        $this->name = $name;
        $this->id = $id ?? $name;
        $this->label = $label;
        $this->hint = $hint;
        $this->disabled = $disabled;
        $this->media = $media;
        $this->tmp = $media[$name];
    }

    public function render(): View
    {
//        $tmp = $this->media[$this->name];
        if ($this->tmp instanceof TemporaryUploadedFile) {
            try {
                $url = $this->tmp->temporaryUrl();
            } catch (Exception) {
                $url = '';
            }

            $this->tmp = [
                'uuid' => Str::orderedUuid()
                    ->toString(),
                'collection' => $this->name,
                'name' => $this->tmp->getClientOriginalName(),
                'size' => $this->tmp->getSize(),
                'url' => $url,
            ];
        }

        if ($this->tmp instanceof Media) {
            $this->tmp = [
                'uuid' => $this->tmp->uuid,
                'collection' => $this->name,
                'name' => $this->tmp->file_name,
                'size' => $this->tmp->size,
                'url' => $this->tmp->getFullUrl(),
            ];
        }

        return view('admix-components::blade.forms.inputs.file');
    }
}