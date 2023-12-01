<?php

namespace Agenciafmd\Components\Blade\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Label extends Component
{
    public string $for;

    public function __construct(string $for)
    {
        $this->for = $for;
    }

    public function render(): View
    {
        return view('admix-components::blade.forms.label');
    }

    public function fallback(): string
    {
        return Str::of($this->for)
            ->ucfirst()
            ->replace('_', ' ');
    }
}