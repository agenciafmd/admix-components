<?php

namespace Agenciafmd\Components\Traits;

use Livewire\WithFileUploads;

trait WithMediaUploads
{
    use WithFileUploads;

    public function deleteMedia(string $collection, string $uuid): void
    {
        $this->model->getMedia($collection)
            ->where('uuid', $uuid)
            ->first()
            ?->delete();

        $this->media = $this->model->refresh()
            ->loadMappedMedia();

        $this->resetValidation("media.{$collection}");
    }

    public function hydrateMedia(): void
    {
        /* TODO: destroy tooltips */
        $this->emit('refreshPlugins');
    }
}
