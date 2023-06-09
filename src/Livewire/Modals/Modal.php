<?php

namespace Agenciafmd\Components\Livewire\Modals;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Modal extends Component
{
    public bool $show = false;

    protected $listeners = [
        'show' => 'show'
    ];

    public function show(): void
    {
        $this->show = true;
    }

    public function render(): View
    {
        return view('admix-components::livewire.modals.modal');
    }
}