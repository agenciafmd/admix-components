<?php

use Agenciafmd\Components\Blade\Forms;
use Agenciafmd\Components\Blade\Cards;
use Agenciafmd\Components\Blade\Buttons;

return [
    'blade' => [
        'btn' => Buttons\Button::class,
        'btn.primary' => Buttons\Primary::class,
        'form' => Forms\Form::class,
        'form.error' => Forms\Error::class,
        'form.label' => Forms\Label::class,
        'form.hint' => Forms\Hint::class,
        'form.input' => Forms\Inputs\Input::class,
        'form.checkbox' => Forms\Inputs\Checkbox::class,
        'form.password' => Forms\Inputs\Password::class,
        'card.title' => Cards\Title::class,
        'card.subtitle' => Cards\Subtitle::class,
    ]
];