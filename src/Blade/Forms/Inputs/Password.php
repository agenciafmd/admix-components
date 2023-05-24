<?php

namespace Agenciafmd\Components\Blade\Forms\Inputs;

use Illuminate\Contracts\View\View;

class Password extends Input
{
    public function __construct(
        string  $name,
        string  $id = null,
        bool    $checked = false,
        ?string $value = '',
        ?string $label = '',
        ?string $hint = '',
    )
    {
        parent::__construct($name, $id, 'password', $value, $label, $hint);
    }

    public function render(): View
    {
        return view('admix-components::blade.forms.inputs.password');
    }
}