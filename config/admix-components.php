<?php

use Agenciafmd\Components\Blade\Buttons;
use Agenciafmd\Components\Blade\Cards;
use Agenciafmd\Components\Blade\Forms;
use Agenciafmd\Components\Blade\Pages;

return [
    'blade' => [
        'btn' => Buttons\Button::class,
        'btn.primary' => Buttons\Primary::class,
        'btn.submit' => Buttons\Submit::class,
        'form' => Forms\Form::class,
        'form.error' => Forms\Error::class,
        'form.label' => Forms\Label::class,
        'form.hint' => Forms\Hint::class,
        'form.input' => Forms\Inputs\Input::class,
        'form.checkbox' => Forms\Inputs\Checkbox::class,
        'form.password' => Forms\Inputs\Password::class,
        'form.plaintext' => Forms\Inputs\Plaintext::class,
        'card.title' => Cards\Title::class,
        'card.subtitle' => Cards\Subtitle::class,
        'page.header' => Pages\Header::class,
        'page.form' => Pages\Form::class,
    ]
];