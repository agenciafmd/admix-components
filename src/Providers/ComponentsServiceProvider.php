<?php

namespace Agenciafmd\Components\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;

class ComponentsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->providers();
        $this->loadTranslations();
        $this->loadLivewireComponents();
    }

    public function register(): void
    {
        $this->loadConfigs();
    }

    private function providers(): void
    {
        $this->app->register(BladeServiceProvider::class);
    }

    private function loadTranslations(): void
    {
        //
    }

    private function loadConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/admix-components.php', 'admix-components');
    }

    private function loadLivewireComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
            foreach (config('admix-components.livewire', []) as $alias => $component) {
                Livewire::component($alias, $component);
            }
        });
    }
}