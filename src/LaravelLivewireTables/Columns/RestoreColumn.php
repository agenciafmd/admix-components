<?php

namespace Agenciafmd\Components\LaravelLivewireTables\Columns;

use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class RestoreColumn extends LinkColumn
{
    protected string $view = 'admix-components::livewire-tables.columns.restore';
}