<?php

namespace Agenciafmd\Components\Blade\Forms\Inputs;

use Illuminate\Contracts\View\View;

class Checkbox extends Input
{
    public bool $checked;
    public string $labelOn;
    public string $labelOff;

    public function __construct(
        string $name,
        string $id = null,
        bool $checked = false,
        ?string $value = '',
        ?string $label = '',
        ?string $hint = '',
        bool $disabled = false,
        ?string $labelOn = '',
        ?string $labelOff = '',
    )
    {
        parent::__construct($name, $id, 'checkbox', $value, $label, $hint, $disabled);

        $this->checked = (bool) old($name, $checked);
        $this->labelOn = $labelOn;
        $this->labelOff = $labelOff;
    }

    public function render(): View
    {
        return view('admix-components::blade.forms.inputs.checkbox');
    }
}