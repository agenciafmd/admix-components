<?php

namespace Agenciafmd\Components\Blade\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Button extends Component
{
    public string $label;
    public ?string $href;

    public function __construct(?string $label = null, ?string $href = null)
    {
        $this->label = $label ?? __('Cancel');
        $this->href = $href ?? (session()->get('backUrl')) ?: route('admix.dashboard');
    }

    public function render(): View
    {
        return view('admix-components::blade.buttons.button');
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