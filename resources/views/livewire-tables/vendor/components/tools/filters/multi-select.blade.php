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
    <div class="form-check">
        <input type="checkbox"
               id="{{ $tableName }}-filter-{{ $filter->getKey() }}@if($filter->hasCustomPosition())-{{ $filter->getCustomPosition() }}@endif-select-all"
               wire:input="selectAllFilterOptions('{{ $filter->getKey() }}')"
               {{ count($component->getAppliedFilterWithValue($filter->getKey()) ?? []) === count($filter->getOptions()) ? 'checked' : ''}}
               class="form-check-input"
        />
        <label class="form-check-label"
               for="{{ $tableName }}-filter-{{ $filter->getKey() }}@if($filter->hasCustomPosition())-{{ $filter->getCustomPosition() }}@endif-select-all">@lang('All')</label>
    </div>
    @foreach($filter->getOptions() as $key => $value)
        <div class="form-check"
             wire:key="{{ $tableName }}-filter-{{ $filter->getKey() }}@if($filter->hasCustomPosition())-{{ $filter->getCustomPosition() }}@endif-multiselect-{{ $key }}">
            <input class="form-check-input"
                   type="checkbox"
                   id="{{ $tableName }}-filter-{{ $filter->getKey() }}@if($filter->hasCustomPosition())-{{ $filter->getCustomPosition() }}@endif-{{ $loop->index }}"
                   value="{{ $key }}"
                   wire:key="{{ $tableName }}-filter-{{ $filter->getKey() }}@if($filter->hasCustomPosition())-{{ $filter->getCustomPosition() }}@endif-{{ $loop->index }}"
                   wire:model.stop="{{ $tableName }}.filters.{{ $filter->getKey() }}"
            />
            <label class="form-check-label"
                   for="{{ $tableName }}-filter-{{ $filter->getKey() }}@if($filter->hasCustomPosition())-{{ $filter->getCustomPosition() }}@endif-{{ $loop->index }}">{{ $value }}</label>
        </div>
    @endforeach
</div>
