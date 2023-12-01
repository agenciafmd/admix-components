<?php

namespace Agenciafmd\Components\Livewire\Modals;

use Illuminate\Contracts\View\View;

class Confirm extends Modal
{
    public string $title = '';
    public string $message = '';
    public string $action = '';

    protected $listeners = [
        'showConfirmationToDelete' => 'showConfirmationToDelete',
    ];

    public function showConfirmationToDelete(int $id): void
    {
        $this->show = true;
        $this->title = __('Attention!');
        $this->message = __('Are you sure you want to delete this record?');
        $this->action = "\$emitUp('bulkDelete', $id);";
    }

    public function render(): View
    {
        return view('admix-components::livewire.modals.confirm');
    }
}