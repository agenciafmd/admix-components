<?php

namespace Agenciafmd\Components\Blade\Forms\Inputs;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class File extends Component
{
    public string $name;
    public string $id;
    public string $label;
    public string $hint;
    public bool $disabled;

    public function __construct(
        string $name,
        string $id = null,
        ?string $label = '',
        ?string $hint = '',
        bool $disabled = false,
    )
    {
        $this->name = Str::of($name)
            ->replace(['model.', 'media.'], '')
            ->__toString();
        $this->id = $id ?? $this->name;
        $this->label = $label;
        $this->hint = $hint;
        $this->disabled = $disabled;
    }

    public function render(): View
    {
        return view('admix-components::blade.forms.inputs.file');
    }
}