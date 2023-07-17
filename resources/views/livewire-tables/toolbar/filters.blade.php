@if ($component->filtersAreEnabled() && $component->filtersVisibilityIsEnabled() && $component->hasVisibleFilters())
    <div class="{{ $component->searchIsEnabled() ? 'ms-0 ms-md-2' : '' }} mb-3 mb-md-0">
        <div @if ($component->isFilterLayoutPopover()) x-data="{ open: false, childElementOpen: false  }"
             x-on:keydown.escape.stop="if (!childElementOpen) { open = false }"
             x-on:mousedown.away="if (!childElementOpen) { open = false }" @endif
             class="btn-group d-block d-md-inline">
            <div>
                <button type="button" class="btn dropdown-toggle d-block w-100 d-md-inline"
                        @if ($component->isFilterLayoutPopover())
                            x-on:click="open = !open"
                        aria-haspopup="true"
                        x-bind:aria-expanded="open"
                        aria-expanded="true"
                        x-bind:class="{ 'show': open }"
                        @endif
                        @if ($component->isFilterLayoutSlideDown())
                            x-on:click="filtersOpen = !filtersOpen"
                        @endif>
                    @lang('Filters')

                    @if ($count = $component->getFilterBadgeCount())
                        <span class="badge bg-info">
                            {{ $count }}
                        </span>
                    @endif

                    <span class="caret"></span>
                </button>
            </div>

            @if ($component->isFilterLayoutPopover())
                <div x-cloak class="dropdown-menu w-100" x-bind:class="{ 'show': open }" role="menu">
                    @foreach ($component->getVisibleFilters() as $filter)
                        <div wire:key="{{ $component->getTableName() }}-filter-{{ $filter->getKey() }}"
                             class="dropdown-item d-block"
                             id="{{ $component->getTableName() }}-filter-{{ $filter->getKey() }}-wrapper">
                            {{ $filter->render($component) }}
                        </div>
                    @endforeach
                    @if ($component->hasAppliedVisibleFiltersWithValuesThatCanBeCleared())
                        <div class="dropdown-divider"></div>
                        <button wire:click.prevent="setFilterDefaults" x-on:click="open = false"
                                class="dropdown-item text-center">
                            @lang('Clear')
                        </button>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endif