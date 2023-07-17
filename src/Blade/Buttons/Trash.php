<?php

namespace Agenciafmd\Components\Blade\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Trash extends Component
{
    public string $label;
    public string $href;

    public function __construct(string $label = null, string $href = null)
    {
        $this->label = __('Trash :name', ['name' => $label]);
        $this->href = $href;
    }

    public function render(): View
    {
        return view('admix-components::blade.buttons.trash');
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