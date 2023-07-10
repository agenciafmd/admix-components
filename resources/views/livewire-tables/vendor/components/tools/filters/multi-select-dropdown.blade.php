@php
    $theme = $component->getTheme();
    $filterLayout = $component->getFilterLayout();
    $tableName = $component->getTableName();
@endphp
<div class="d-block w-100">
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
    <select multiple
            wire:model.stop="{{ $tableName }}.filters.{{ $filter->getKey() }}"
            wire:key="{{ $tableName }}-filter-{{ $filter->getKey() }}@if($filter->hasCustomPosition())-{{ $filter->getCustomPosition() }}@endif"
            id="{{ $tableName }}-filter-{{ $filter->getKey() }}@if($filter->hasCustomPosition())-{{ $filter->getCustomPosition() }}@endif"
            class="form-select">
        @if ($filter->getFirstOption() != "")
            <option @if($filter->isEmpty($this)) selected @endif value="all">{{ $filter->getFirstOption()}}</option>
        @endif
        @foreach($filter->getOptions() as $key => $value)
            @if (is_iterable($value))
                <optgroup label="{{ $key }}">
                    @foreach ($value as $optionKey => $optionValue)
                        <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                    @endforeach
                </optgroup>
            @else
                <option value="{{ $key }}">{{ $value }}</option>
            @endif
        @endforeach
    </select>
</div>
