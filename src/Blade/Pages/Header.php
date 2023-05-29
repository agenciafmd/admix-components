<?php

namespace Agenciafmd\Components\Blade\Pages;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Header extends Component
{
    public string $title;

    public function __construct(string $title = '')
    {
        $this->title = $title;
    }

    public function render(): View
    {
        return view('admix-components::blade.pages.header');
    }

    public function fallback(): string
    {
        return Str::of($this->title)
            ->stripTags()
            ->squish();
    }
}