<?php

namespace Agenciafmd\Components\Blade\Cards;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Subtitle extends Component
{
    public string $subtitle;

    public function __construct(string $subtitle = '')
    {
        $this->subtitle = $subtitle;
    }

    public function render(): View
    {
        return view('admix-components::blade.cards.subtitle');
    }

    public function fallback(): string
    {
        return Str::of($this->subtitle)
            ->stripTags()
            ->squish()
            ->lower()
            ->ucfirst();
    }
}