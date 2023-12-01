<?php

namespace Agenciafmd\Components\Blade\Forms\Inputs;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    public string $name;
    public string $id;
    public string $rows;
    public string $value;
    public string $label;
    public string $hint;
    public bool $disabled;

    public function __construct(
        string $name,
        string $id = null,
        string $rows = '8',
        ?string $value = '',
        ?string $label = '',
        ?string $hint = '',
        bool $disabled = false,
    )
    {
        $this->name = $name;
        $this->id = $id ?? $name;
        $this->rows = $rows;
        $this->value = old($name, $value ?? '');
        $this->label = $label;
        $this->hint = $hint;
        $this->disabled = $disabled;
    }

    public function render(): View
    {
        return view('admix-components::blade.forms.inputs.textarea');
    }
}