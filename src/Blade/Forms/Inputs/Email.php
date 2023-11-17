<?php

namespace Agenciafmd\Components\Blade\Forms\Inputs;

class Email extends Input
{
    public function __construct(
        string  $name,
        string  $id = null,
        ?string $value = '',
        ?string $label = '',
        ?string $hint = '',
        bool    $disabled = false,
    )
    {
        parent::__construct($name, $id, 'email', $value, $label, $hint, $disabled);
    }
}
