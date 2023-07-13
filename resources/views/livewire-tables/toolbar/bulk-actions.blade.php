@if ($component->showBulkActionsDropdownAlpine())
    <div x-cloak x-show="selectedItems.length > 0" class="mb-3 mb-md-0">
        <div class="dropdown d-block d-md-inline">
            <button class="btn dropdown-toggle d-block w-100 d-md-inline" type="button"
                    id="{{ $component->getTableName() }}-bulkActionsDropdown" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                @lang('Bulk Actions')
            </button>

            <div class="dropdown-menu w-100"
                 aria-labelledby="{{ $component->getTableName() }}-bulkActionsDropdown">
                @foreach ($component->getBulkActions() as $action => $title)
                    <a href="#" wire:click.prevent="{{ $action }}"
                       wire:key="bulk-action-{{ $action }}-{{ $component->getTableName() }}"
                       class="dropdown-item">
                        {{ $title }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif