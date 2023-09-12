<?php

namespace Agenciafmd\Components\LaravelLivewireTables\Columns;

use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class ModalColumn extends LinkColumn
{
    protected string $view = 'admix-components::livewire-tables.columns.modal';
}