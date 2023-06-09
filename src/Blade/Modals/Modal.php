<?php

namespace Agenciafmd\Components\Blade\Modals;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public string $title;
    public string $action;
    public string $type;

    public function __construct(string $title, string $action, string $type = '')
    {
        $this->title = $title;
        $this->action = $action;
        $this->type = $type;
    }

    public function render(): View
    {
        return view('admix-components::blade.modals.modal');
    }
}