@aware(['component'])
@props([
    'filter',
    'theme' => 'tailwind',
    'filterLayout' => 'popover',
    'tableName' => 'table'
])

<label for="{{ $tableName }}-filter-{{ $filter->getKey() }}"
       class="form-label">
    {{ Str::of($filter->getName())->ucfirst() }}
</label>
