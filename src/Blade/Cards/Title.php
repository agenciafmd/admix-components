<?php

namespace Agenciafmd\Components\Blade\Cards;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Title extends Component
{
    public string $title;

    public function __construct(string $title = '')
    {
        $this->title = $title;
    }

    public function render(): View
    {
        return view('admix-components::blade.cards.title');
    }

    public function fallback(): string
    {
        return Str::of($this->title)
            ->stripTags()
            ->squish()
            ->lower()
            ->ucfirst();
    }
}