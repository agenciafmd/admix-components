@php
    $theme = $component->getTheme();
    $filterLayout = $component->getFilterLayout();
    $tableName = $component->getTableName();
@endphp
<div>
    @if($filter->hasCustomFilterLabel() && !$filter->hasCustomPosition())
        @include($filter->getCustomFilterLabel(), [
                'filter' => $filter,
                'theme' => $theme,
                'filterLayout' => $filterLayout,
                'tableName' => $tableName
            ])
    @elseif(!$filter->hasCustomPosition())
        <x-livewire-tables::tools.filter-label
                :filter="$filter"
                :theme="$theme"
                :filterLayout="$filterLayout"
                :tableName="$tableName"
        />
    @endif
    <input wire:model.stop="{{ $tableName }}.filters.{{ $filter->getKey() }}"
           wire:key="{{ $tableName }}-filter-{{ $filter->getKey() }}@if($filter->hasCustomPosition())-{{ $filter->getCustomPosition() }}@endif"
           id="{{ $tableName }}-filter-{{ $filter->getKey() }}@if($filter->hasCustomPosition())-{{ $filter->getCustomPosition() }}@endif"
           type="date"
           @if($filter->hasConfig('min')) min="{{ $filter->getConfig('min') }}" @endif
           @if($filter->hasConfig('max')) max="{{ $filter->getConfig('max') }}" @endif
           class="form-control"
    />
</div>
