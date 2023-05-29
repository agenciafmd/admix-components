<?php

namespace Agenciafmd\Components\Blade\Pages;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public string $headerTitle;

    public function __construct(string $headerTitle = '')
    {
        $this->headerTitle = $headerTitle;
    }

    public function render(): View
    {
        return view('admix-components::blade.pages.form');
    }
}