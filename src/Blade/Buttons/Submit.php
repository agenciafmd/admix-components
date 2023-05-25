<?php

namespace Agenciafmd\Components\Blade\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Submit extends Component
{
    public ?string $action;
    public string $method;

    public function __construct(string $action = null, string $method = 'POST')
    {
        $this->action = $action;
        $this->method = strtoupper($method);
    }

    public function render(): View
    {
        return view('admix-components::blade.buttons.submit');
    }
}