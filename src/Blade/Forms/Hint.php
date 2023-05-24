<?php

namespace Agenciafmd\Components\Blade\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Hint extends Component
{
    public string $message;

    public function __construct(string $message = '')
    {
        $this->message = $message;
    }

    public function render(): View
    {
        return view('admix-components::blade.forms.hint');
    }

    public function fallback(): string
    {
        return Str::of($this->message)
            ->stripTags()
            ->squish();
    }
}