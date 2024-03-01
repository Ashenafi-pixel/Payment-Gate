<div class="flex-mode gap-2  justify-content-lg-end">
    <button class="btn btn-secondary flex-mode" onClick="switchView()">
        <span id="view-symbol" class="material-symbols-outlined ">
            grid_view
        </span>
    </button>
    <button class="btn btn-green flex-mode gap-2" data-bs-toggle="offcanvas" data-bs-target="#filter">
        <span class="material-symbols-outlined">
            tune
        </span>
        {{__('Filter')}}
    </button>
</div>

<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="filter"  >
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="Enable both scrolling & backdrop">All Merchant</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <p>{{ __('Use this section to filter your records') }}</p>
        <form action="">
            <div class="row gy-3">
                <div class="col-12">
                    <label for="" class="form-label">{{ __('From') }}</label>
                    <input type="date" class="form-control form-control-lg">
                </div>
                <div class="col-12">
                    <label for="" class="form-label">{{ __('To') }}</label>
                    <input type="date" class="form-control form-control-lg">
                </div>
                <div class="col-12 mt-4 flex-mode content-end">
                    <button type="reset" class="btn btn-danger flex-mode gap-2"  data-bs-dismiss="offcanvas">
                    <span class="material-symbols-outlined">
                        close
                     </span>
                        {{ __('Cancel') }}
                    </button>
                    <button class="btn btn-green flex-mode gap-2">
                    <span class="material-symbols-outlined">
                        filter_list
                     </span>
                        {{ __('Apply Filters') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
