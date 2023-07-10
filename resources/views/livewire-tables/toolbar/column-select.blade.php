@if ($component->columnSelectIsEnabled())
    <div class="@if ($component->getColumnSelectIsHiddenOnMobile()) d-none d-sm-block @elseif ($component->getColumnSelectIsHiddenOnTablet()) d-none d-md-block @endif mb-3 mb-md-0 md-0 ms-md-2">
        <div x-data="{ open: false, childElementOpen: false }"
             x-on:keydown.escape.stop="if (!childElementOpen) { open = false }"
             x-on:mousedown.away="if (!childElementOpen) { open = false }"
             class="dropdown d-block d-md-inline"
             wire:key="column-select-button-{{ $component->getTableName() }}">
            <button x-on:click="open = !open" class="btn dropdown-toggle d-block w-100 d-md-inline"
                    type="button" id="columnSelect-{{ $component->getTableName() }}" aria-haspopup="true"
                    x-bind:aria-expanded="open">
                @lang('Columns')
            </button>

            <div class="dropdown-menu dropdown-menu-end w-100" x-bind:class="{ 'show': open }"
                 aria-labelledby="columnSelect-{{ $component->getTableName() }}">
                <div class="form-check ms-2">
                    <input
                            @if ($component->allDefaultVisibleColumnsAreSelected()) checked
                            wire:click="deselectAllColumns"
                            @else
                                unchecked
                            wire:click="selectAllColumns" @endif
                            wire:loading.attr="disabled" type="checkbox" class="form-check-input"/>
                    <label wire:loading.attr="disabled" class="form-check-label">
                        {{ __('All Columns') }}
                    </label>
                </div>
                @foreach ($component->getColumns() as $column)
                    @if ($column->isVisible() && $column->isSelectable())
                        <div wire:key="columnSelect-{{ $loop->index }}-{{ $component->getTableName() }}"
                             class="form-check ms-2">
                            <input wire:model="selectedColumns" wire:target="selectedColumns"
                                   wire:loading.attr="disabled" type="checkbox" class="form-check-input"
                                   value="{{ $column->getSlug() }}"/>
                            <label wire:loading.attr="disabled" wire:target="selectedColumns"
                                   class="{{ $loop->last ? 'mb-0' : 'mb-1' }} form-check-label">{{ $column->getTitle() }}</label>

                            </label>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif