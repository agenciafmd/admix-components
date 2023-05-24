<?php

namespace Agenciafmd\Components\Providers;

use Agenciafmd\Components\Blade\Forms\Inputs\Input;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class ComponentsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViews();
        $this->loadTranslations();
        $this->loadBladeComponents();
    }

    public function register(): void
    {
        $this->loadConfigs();
    }

    private function loadViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'admix-components');
    }

    private function loadTranslations(): void
    {
        //
    }

    private function loadConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/admix-components.php', 'admix-components');
    }

    private function loadBladeComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
            foreach (config('admix-components.blade', []) as $alias => $component) {
                $blade->component($component, $alias);
            }
        });
    }
}