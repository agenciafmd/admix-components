@if (
    $component->filtersAreEnabled() &&
        $component->filtersVisibilityIsEnabled() &&
        $component->hasVisibleFilters() &&
        $component->isFilterLayoutSlideDown())
    <div x-cloak x-show="filtersOpen">
        <div class="container">
            @foreach ($component->getFiltersByRow() as $filterRow)
                <div class="row">
                    @foreach ($filterRow as $filter)
                        @if ($filter->isVisibleInMenus())
                            <div @class([
                                    'space-y-1 col-12 col-span-1 mb-4',
                                    'col-sm-6 col-md-4 col-lg-3' => !$filter->hasFilterSlidedownColspan(),
                                    'col-sm-6 col-md-6 col-lg-6' =>
                                        $filter->hasFilterSlidedownColspan() &&
                                        $filter->getFilterSlidedownColspan() == 2,
                                    'col-sm-9 col-md-9 col-lg-9' =>
                                        $filter->hasFilterSlidedownColspan() &&
                                        $filter->getFilterSlidedownColspan() == 3,
                                    'col-sm-12 col-md-12 col-lg-12' =>
                                        $filter->hasFilterSlidedownColspan() &&
                                        $filter->getFilterSlidedownColspan() == 4,
                                ])
                                 id="{{ $component->getTableName() }}-filter-{{ $filter->getKey() }}-wrapper">
                                {{ $filter->render($component) }}
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endif