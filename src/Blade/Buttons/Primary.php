<?php

namespace Agenciafmd\Components\Blade\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Primary extends Component
{
    public string $label;

    public function __construct(?string $label = null)
    {
        $this->label = $label ?? __('Save');
    }

    public function render(): View
    {
        return view('admix-components::blade.buttons.primary');
    }

    public function fallback(): string
    {
        return Str::of($this->label)
            ->stripTags()
            ->squish()
            ->lower()
            ->ucfirst();
    }
}