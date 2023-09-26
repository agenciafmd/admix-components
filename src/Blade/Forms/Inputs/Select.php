<?php

namespace Agenciafmd\Components\Blade\Forms\Inputs;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public string $name;
    public array $options;
    public string $id;
    public string $value;
    public string $label;
    public string $hint;
    public string $placeholder;
    public bool $disabled;

    public function __construct(
        string  $name,
        array   $options = [],
        string  $id = null,
        ?string $value = '',
        ?string $label = '',
        ?string $hint = '',
        ?string $placeholder = '',
        bool $disabled = false,
    )
    {
        $this->name = $name;
        $this->options = $options;
        $this->id = $id ?? $name;
        $this->value = old($name, $value ?? '');
        $this->label = $label;
        $this->hint = $hint;
        $this->placeholder = $placeholder;
        $this->disabled = $disabled;
    }

    public function render(): View
    {
        return view('admix-components::blade.forms.inputs.select');
    }
}