<?php

namespace Agenciafmd\Components\Blade\Forms\Inputs;

class Number extends Input
{
    public function __construct(
        string $name,
        string $id = null,
        ?string $value = '',
        ?string $label = '',
        ?string $hint = '',
        bool $disabled = false,
    )
    {
        parent::__construct($name, $id, 'number', $value, $label, $hint, $disabled);
    }
}
