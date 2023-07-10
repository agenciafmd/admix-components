<?php

namespace Agenciafmd\Components\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class BladeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadBladeComponents();

        $this->loadBladeDirectives();

        $this->loadViews();

        $this->publish();
    }

    public function register(): void
    {
        //
    }

    private function loadBladeComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
            foreach (config('admix-components.blade', []) as $alias => $component) {
                $blade->component($component, $alias);
            }
        });
    }

    private function loadBladeDirectives(): void
    {
        //
    }

    private function loadViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'admix-components');
    }

    private function publish(): void
    {
        $this->publishes([
            __DIR__ . '/../../resources/views/livewire-tables/vendor/components' => base_path('resources/views/vendor/livewire-tables/components'),
        ], ['admix-views']);

        $this->publishes([
            __DIR__ . '/../resources/views/livewire-tables/columns' => base_path('resources/views/vendor/agenciafmd/admix-components/livewire-tables/columns'),
            __DIR__ . '/../resources/views/livewire-tables/includes' => base_path('resources/views/vendor/agenciafmd/admix-components/livewire-tables/includes'),
            __DIR__ . '/../resources/views/livewire-tables/toolbar' => base_path('resources/views/vendor/agenciafmd/admix-components/livewire-tables/toolbar'),
        ], ['admix-components-livewire-tables']);
    }
}
