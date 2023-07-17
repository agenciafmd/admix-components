<div class="page-wrapper">
    <x-page.header>
        {{ __($pageTitle) }}
        <x-slot:actions>
            <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
                    @foreach($headerActions as $action)
                        <div class="ms-2">
                            {!! Blade::render($action) !!}
                        </div>
                    @endforeach
                </div>
            </div>
        </x-slot:actions>
    </x-page.header>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                @include('livewire-tables::datatable')
            </div>
        </div>
    </div>
</div>