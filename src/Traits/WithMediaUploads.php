<?php

namespace Agenciafmd\Components\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

trait WithMediaUploads
{
    use WithFileUploads;

    public function deleteMedia(string $collection, string $id = ''): void
    {
        $uuids = ($id !== '') ? Arr::wrap($id) : $this->selectedMedia;

        foreach ($uuids as $uuid) {
            if (Str::of($uuid)
                ->isUuid()) {
                $this->model->getMedia($collection)
                    ->where('uuid', $uuid)
                    ->first()
                    ?->delete();

                $this->loadedMedia = $this->model->refresh()
                    ->loadMappedMedia();
            } else {
                $this->resetValidation("media.{$collection}.{$uuid}");
                unset($this->media[$collection][$uuid]);
                $this->media[$collection] = array_values($this->media[$collection]);
            }
        }

        $this->selectedMedia = [];
    }

    public function hydrateMedia(array $data): void
    {
        /* TODO: destroy tooltips */
        $this->emit('refreshPlugins');
    }
}
