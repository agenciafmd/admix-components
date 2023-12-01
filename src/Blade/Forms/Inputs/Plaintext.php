<?php

namespace Agenciafmd\Components\Blade\Forms\Inputs;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Plaintext extends Component
{
    public string $value;
    public string $label;
    public bool $disabled;

    public function __construct(
        string $value = '',
        ?string $label = '',
        bool $disabled = false,
    )
    {
        $this->value = $value;
        $this->label = $label;
        $this->disabled = $disabled;
    }

    public function render(): View
    {
        return view('admix-components::blade.forms.inputs.plaintext');
    }
}