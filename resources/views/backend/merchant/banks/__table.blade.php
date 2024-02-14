<style>
    /* Remove border */
    input[type="text"].paragraph-like {
        border: none;
        background-color: transparent;
        padding: 0;
        font-size: inherit;
        font-family: inherit;
        outline: none;
    }
</style>

<div class="table-responsive table-nowrap d-box p-0 border-radius-0">
    @if (Session::has('success'))
        <div id="successMessage" class="alert alert-success">
            {{ Session::get('success') }}
        </div>

        <script>
            setTimeout(function() {
                document.getElementById('successMessage').style.display = 'none';
            }, 5000); // 5000 milliseconds = 5 seconds
        </script>
    @endif
    <table class="table">
        <thead class="sticky-top">
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Account Number') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @forelse($banks as $bank)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $bank->name ?? \App\Helpers\GeneralHelper::EMPTY_DASHES() }}</td>
                    <td>{{ $bank->id }}</td>

                    <td>
                        <div class="btn-group">
                            <button class="btn btn-green-light flex-mode" type="button" id="action"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="material-symbols-outlined">
                                    more_vert
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end animated zoomIn" aria-labelledby="action">

                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                @include('backend.partials.no-table-data')
            @endforelse
        </tbody>
    </table>
</div>
