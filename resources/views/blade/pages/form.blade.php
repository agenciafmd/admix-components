<div class="page-wrapper">
    <x-page.header>
        {{ $headerTitle }}
        <x-slot:actions>
            {{ $headerActions ?? '' }}
        </x-slot:actions>
    </x-page.header>
    <div class="page-body">
        <div class="container-xl">
            <x-form>
                <div class="card">
                    <div class="row g-0">
                        <div class="col-12 col-md-8 border-end">
                            <div class="card-body">
                                {{ $slot }}
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex flex-column">
                            <div class="card-body">
                                {{ $cardComplement }}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent mt-auto">
                        <div class="btn-list justify-content-end">
                            <x-btn/>
                            <x-btn.primary/>
                        </div>
                    </div>
                </div>
            </x-form>
        </div>
    </div>
</div>
