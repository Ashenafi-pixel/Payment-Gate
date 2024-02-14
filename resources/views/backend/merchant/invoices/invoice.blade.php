@extends('backend.layouts.app')
@section('title','Oddo Requests')
@section('content')
    <div class="row">
        <div class="col-6 my-auto">
            <h2 class="page-title"> {{__('Create Invoice')}}</h2>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.invoices.index') }}" class="btn btn-theme ">
                <div class="flex-mode gap-2">
                <span class="material-symbols-outlined">
                    view_list
                </span>
                    {{__(' All Oddo Requests')}}
                </div>
            </a>
        </div>
        @include('backend.merchant.invoices._form')
    </div>
@endsection
@push('js')
    <script src="{{ asset('backend/js/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.customer').on('change', function () {
                let customer = $(this).find(':selected').data('customer');
                let phone = customer.mobile_number;
                let name = customer.name;
                $('#name').val(name);
                $('#phone').val(phone);
            })


            $('.requestform').on('submit', function (e) {
                e.preventDefault();
                var loading = true;
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    type: "POST",
                    url: this.action,
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function() {
                        (loading) ? preLoader('show') : '';
                    },
                    success: function (res) {
                        (loading) ? preLoader('hide') : '';

                        if (!res.status) {
                            if (res.message !== undefined)
                                if (res.message !== '' && res.message !== null){
                                    notifier('error',errorIcon(res.message));
                                }

                            return false;
                        }
                        var route = res.data;
                        $('#route').val(route);
                        var qrCodeUrl = 'https://chart.googleapis.com/chart?cht=qr&chl=' + encodeURIComponent(route) + '&chs=160x160';
                        Swal.fire({
                            title: 'Request Link Created',
                            html: '<img src="' + qrCodeUrl + '" alt="QR Code">',
                            input: 'text',
                            inputValue: route,
                            confirmButtonText: `Copy`,
                            icon: 'success',
                            showCancelButton: true,
                            customClass: {
                                input: 'customroute',
                            }
                        }).then((result) => {
                            if (result.value)  {
                                var range = document.createRange();
                                range.selectNode(document.querySelector(".customroute"));
                                window.getSelection().removeAllRanges(); // clear current selection
                                window.getSelection().addRange(range);
                                document.execCommand("copy");
                                notifier('success', 'Copied!');
                                setTimeout(function() {
                                    window.location.reload();
                                }, 2500);
                            }
                        })
                    },
                    error: function(err)
                    {
                        (loading) ? preLoader('hide') : '';

                        if (err.status === 422) {
                            let errors = (err.responseJSON)
                                ? err.responseJSON.errors
                                : JSON.parse(err.responseText).errors;

                            populateErrors(form, errors);
                            return;
                        }

                        if (err.responseJSON.message !== '' && err.responseJSON.message !== null) {
                            notifier('error',errorIcon(err.responseJSON.message));
                        }
                    }
                });
            })

            var preload = document.getElementById('loading');
            function hideLoader()
            {
                preload.style.display = "none";
            }

            function showLoader()
            {
                preload.style.display = "block";
            }

        })
    </script>
@endpush
