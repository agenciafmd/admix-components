<?php

namespace Agenciafmd\Components\Blade\Forms\Inputs;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public string $name;
    public string $id;
    public string $type;
    public string $value;
    public string $label;
    public string $hint;
    public bool $disabled;

    public function __construct(
        string $name,
        string $id = null,
        string $type = 'text',
        ?string $value = '',
        ?string $label = '',
        ?string $hint = '',
        bool $disabled = false,
    )
    {
        $this->name = $name;
        $this->id = $id ?? $name;
        $this->type = $type;
        $this->value = old($name, $value ?? '');
        $this->label = $label;
        $this->hint = $hint;
        $this->disabled = $disabled;
    }

    public function render(): View
    {
        return view('admix-components::blade.forms.inputs.input');
    }
}