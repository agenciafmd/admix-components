<?php

namespace Agenciafmd\Components\Livewire\Modals;

use Illuminate\Contracts\View\View;

class Html extends Modal
{
    public string $title = '';
    public string $message = '';
    public string $action = '';

    protected $listeners = [
        'showHtml' => 'showHtml',
    ];

    public function showHtml(string $message): void
    {
        $this->show = true;
        $this->title = __('Information');
        $this->message = $message;
        $this->action = ''; //"\$emitUp('bulkDelete', $id);";
    }

    public function render(): View
    {
        return view('admix-components::livewire.modals.html');
    }
}