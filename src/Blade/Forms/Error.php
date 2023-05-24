<?php

namespace Agenciafmd\Components\Blade\Forms;

use Illuminate\Support\ViewErrorBag;
use Illuminate\View\View;
use Illuminate\View\Component;

class Error extends Component
{
    public string $field;
    public string $bag;

    public function __construct(string $field, string $bag = 'default')
    {
        $this->field = $field;
        $this->bag = $bag;
    }

    public function render(): View
    {
        return view('admix-components::blade.forms.error');
    }

    public function messages(ViewErrorBag $errors): array
    {
        $bag = $errors->getBag($this->bag);

        return $bag->has($this->field) ? $bag->get($this->field) : [];
    }
}