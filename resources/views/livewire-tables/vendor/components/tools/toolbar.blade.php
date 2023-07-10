@aware(['component'])

@php
    $theme = $component->getTheme();
@endphp

@if ($component->hasConfigurableAreaFor('before-toolbar'))
    @include(
        $component->getConfigurableAreaFor('before-toolbar'),
        $component->getParametersForConfigurableArea('before-toolbar'))
@endif

<div class="d-md-flex justify-content-between mb-3">
    <div class="d-md-flex">
        @if ($component->hasConfigurableAreaFor('toolbar-left-start'))
            @include(
                $component->getConfigurableAreaFor('toolbar-left-start'),
                $component->getParametersForConfigurableArea('toolbar-left-start'))
        @endif

        @include('admix-components::livewire-tables.toolbar.reorder')

        @include('admix-components::livewire-tables.toolbar.search')

        @include('admix-components::livewire-tables.toolbar.filters')

        @if ($component->hasConfigurableAreaFor('toolbar-left-end'))
            @include(
                $component->getConfigurableAreaFor('toolbar-left-end'),
                $component->getParametersForConfigurableArea('toolbar-left-end'))
        @endif
    </div>

    <div class="d-md-flex">
        @if ($component->hasConfigurableAreaFor('toolbar-right-start'))
            @include(
                $component->getConfigurableAreaFor('toolbar-right-start'),
                $component->getParametersForConfigurableArea('toolbar-right-start'))
        @endif

        @include('admix-components::livewire-tables.toolbar.bulk-actions')

        @include('admix-components::livewire-tables.toolbar.column-select')

        @include('admix-components::livewire-tables.toolbar.pagination')

        @if ($component->hasConfigurableAreaFor('toolbar-right-end'))
            @include(
                $component->getConfigurableAreaFor('toolbar-right-end'),
                $component->getParametersForConfigurableArea('toolbar-right-end'))
        @endif
    </div>
</div>

@include('admix-components::livewire-tables.toolbar.filters-rows')

@if ($component->hasConfigurableAreaFor('after-toolbar'))
    @include(
        $component->getConfigurableAreaFor('after-toolbar'),
        $component->getParametersForConfigurableArea('after-toolbar'))
@endif
