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
           type="text"
           @if($filter->hasConfig('placeholder')) placeholder="{{ $filter->getConfig('placeholder') }}" @endif
           @if($filter->hasConfig('maxlength')) maxlength="{{ $filter->getConfig('maxlength') }}" @endif
           class="form-control"
    />
</div>
