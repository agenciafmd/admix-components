<?php

namespace Agenciafmd\Components\Blade\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Form extends Component
{
    public ?string $action;
    public ?string $method;
    public bool $hasFiles;

    public function __construct(string $action = null, string $method = null, bool $hasFiles = false)
    {
        $this->action = $action;
        $this->method = $method;
        $this->hasFiles = $hasFiles;
    }

    public function render(): View
    {
        return view('admix-components::blade.forms.form');
    }
}