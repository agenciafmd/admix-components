@if ($component->paginationIsEnabled() && $component->perPageVisibilityIsEnabled())
    <div class="ms-0 ms-md-2">
        <select wire:model="perPage" id="perPage" class="form-select">
            @foreach ($component->getPerPageAccepted() as $item)
                <option value="{{ $item }}"
                        wire:key="per-page-{{ $item }}-{{ $component->getTableName() }}">
                    {{ $item === -1 ? __('All') : $item }}</option>
            @endforeach
        </select>
    </div>
@endif
