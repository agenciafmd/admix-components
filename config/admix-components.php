<?php

use Agenciafmd\Components\Blade\Buttons;
use Agenciafmd\Components\Blade\Cards;
use Agenciafmd\Components\Blade\Forms;
use Agenciafmd\Components\Blade\Modals;
use Agenciafmd\Components\Blade\Pages;
use Agenciafmd\Components\Livewire\Modals as LivewireModals;

return [
    'blade' => [
        'btn' => Buttons\Button::class,
        'btn.create' => Buttons\Create::class,
        'btn.primary' => Buttons\Primary::class,
        'btn.submit' => Buttons\Submit::class,
        'btn.trash' => Buttons\Trash::class,
        'card.title' => Cards\Title::class,
        'card.subtitle' => Cards\Subtitle::class,
        'form' => Forms\Form::class,
        'form.error' => Forms\Error::class,
        'form.label' => Forms\Label::class,
        'form.hint' => Forms\Hint::class,
        'form.input' => Forms\Inputs\Input::class,
        'form.checkbox' => Forms\Inputs\Checkbox::class,
        'form.password' => Forms\Inputs\Password::class,
        'form.plaintext' => Forms\Inputs\Plaintext::class,
        'form.select' => Forms\Inputs\Select::class,
        'modal' => Modals\Modal::class,
        'page.header' => Pages\Header::class,
        'page.form' => Pages\Form::class,
    ],
    'livewire' => [
        'modal.confirm' => LivewireModals\Confirm::class,
    ]
];