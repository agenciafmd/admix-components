<?php

namespace Agenciafmd\Components\Blade\Forms\Inputs;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Plaintext extends Component
{
    public string $value;
    public string $label;

    public function __construct(
        string  $value = '',
        ?string $label = '',
    )
    {
        $this->value = $value;
        $this->label = $label;
    }

    public function render(): View
    {
        return view('admix-components::blade.forms.inputs.plaintext');
    }
}