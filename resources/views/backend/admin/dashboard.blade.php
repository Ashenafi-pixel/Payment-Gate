@extends('backend.layouts.app')
@section('title', 'Dashboard')
@section('content')
    <h1 class="page-title mb-3">Overview</h1>
    <form action="{{ route(\App\Helpers\GeneralHelper::WHO_AM_I() . '.index') }}" method="get" id="payment_filter">
        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="d-box  ">
                    <div class="text-end mb-2">
                        <img height="30" class="filter" src="{{ asset('images/icons/d-merchant.svg') }}" alt="">
                    </div>
                    <h3 class="d-heading ">
                        <span data-purecounter-duration="2.5" data-purecounter-end="{{ $totalMerchantsCount }}"
                            class="purecounter">{{ $totalMerchantsCount }}</span>
                    </h3>
                    <img width="34" class='img-loader' src="{{ asset('images/loader.gif') }}" alt="">
                    <p class="d-text ">Total Merchants</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="d-box  ">
                    <div class="text-end mb-2">
                        <img height="30" src="{{ asset('images/icons/d-active-merchant.svg') }}" alt="">
                    </div>
                    <h3 class="d-heading ">
                        <span data-purecounter-duration="2.5" data-purecounter-end="{{ $activeMerchantsCount }}"
                            class="purecounter">{{ $activeMerchantsCount }}</span>
                    </h3>
                    <img width="34" class='img-loader' src="{{ asset('images/loader.gif') }}" alt="">
                    <p class="d-text ">Active Merchants</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="d-box  ">
                    <div class="text-end mb-2">
                        <img height="30" src="{{ asset('images/icons/d-pending-merchant.svg') }}" alt="">
                    </div>
                    <h3 class="d-heading ">
                        <span data-purecounter-duration="2.5" data-purecounter-end="{{ $pendingMerchantsCount }}"
                            class="purecounter">{{ $pendingMerchantsCount }}</span>
                    </h3>
                    <img width="34" class='img-loader' src="{{ asset('images/loader.gif') }}" alt="">
                    <p class="d-text ">Pending Merchants</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="d-box  ">
                    <div class="text-end mb-2">
                        <img height="30" src="{{ asset('images/icons/d-rejected-merchant.svg') }}" alt="">
                    </div>
                    <h3 class="d-heading ">
                        <span data-purecounter-duration="2.5" data-purecounter-end="{{ $rejectedMerchantsCount }}"
                            class="purecounter">{{ $rejectedMerchantsCount }}</span>
                    </h3>
                    <img width="34" class='img-loader' src="{{ asset('images/loader.gif') }}" alt="">
                    <p class="d-text ">Rejected Merchants</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="d-box  ">
                    <div class="text-end mb-2">
                        <img height="30" class="filter" src="{{ asset('images/icons/d-total-customer.svg') }}"
                            alt="">
                    </div>
                    <h3 class="d-heading ">
                        <span data-purecounter-duration="2.5" data-purecounter-end="{{ $totalCustomersCount }}"
                            class="purecounter">{{ $totalCustomersCount }}</span>
                    </h3>
                    <img width="34" class='img-loader' src="{{ asset('images/loader.gif') }}" alt="">
                    <p class="d-text ">Total Customers</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="d-box  ">
                    <div class="text-end mb-2">
                        <img height="30" class="filter" src="{{ asset('images/icons/d-total-invoices.svg') }}"
                            alt="">
                    </div>
                    <h3 class="d-heading "> <span data-purecounter-duration="2.5"
                            data-purecounter-end="{{ $totalInvoicesCount }}"
                            class="purecounter">{{ $totalInvoicesCount }}</span></h3>
                    <img width="34" class='img-loader' src="{{ asset('images/loader.gif') }}" alt="">
                    <p class="d-text ">Total Invoices</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="d-box  ">
                    <div class="text-end mb-2">
                        <img height="30" src="{{ asset('images/icons/d-pending-invoices.svg') }}" alt="">
                    </div>
                    <img width="34" class='img-loader' src="{{ asset('images/loader.gif') }}" alt="">
                    <h3 class="d-heading "> <span data-purecounter-duration="2.5"
                            data-purecounter-end="{{ $pendingInvoicesCount }}"
                            class="purecounter">{{ $pendingInvoicesCount }}</span></h3>
                    <p class="d-text ">Pending Invoices</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="d-box  ">
                    <div class="text-end mb-2">
                        <img height="30" src="{{ asset('images/icons/d-approved-invoices.svg') }}" alt="">
                    </div>
                    <img width="34" class='img-loader' src="{{ asset('images/loader.gif') }}" alt="">
                    <h3 class="d-heading "> <span data-purecounter-duration="2.5"
                            data-purecounter-end="{{ $activeInvoicesCount }}"
                            class="purecounter">{{ $activeInvoicesCount }}</span></h3>
                    <p class="d-text ">Paid Invoices</p>
                </div>
            </div>
            <!---Invoice Chart------->
            <div class="col-12">
                <div class="flex-mode justify-content-between mb-3">
                    <h3 class="page-title">Invoices
                        <span class="sub-heading ps-2">Monthly</span>
                    </h3>
                    <div class="d-flex gap-2">
                        <select name="" id="" class="chart-select">
                            @for ($i = 1; $i <= 31; $i++)
                                <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                        <select name="" id="" class="chart-select">
                            <option value="">January</option>
                            <option value="">February</option>
                            <option value="">March</option>
                        </select>
                        <select name="" id="" class="chart-select">
                            <option value="">2023</option>
                            <option value="">2022</option>
                            <option value="">2021</option>
                        </select>
                    </div>
                </div>
                <div class="d-box chart-height" id="chart-main">
                    <div id="chart"></div>
                </div>
            </div>
            <!----Pending invoices chart---->
            <div class="col-md-6">
                <div class="flex-mode justify-content-between mb-3">
                    <h3 class="page-title">Withdraw Pending <br> Requests</h3>
                    <div class="d-flex gap-2">
                        <select name="" id="" class="chart-select">
                            <option value="">Q1(First six months)</option>
                            <option value="">Q2(Last six months)</option>
                        </select>
                        <select name="" id="" class="chart-select">
                            <option value="">2023</option>
                            <option value="">2022</option>
                            <option value="">2021</option>
                        </select>
                    </div>
                </div>
                <div class="d-box chart-height">
                    <div id="pending-invoice">

                    </div>
                </div>
            </div>
            <!---Approved invoices chart---->
            <div class="col-md-6">
                <div class="flex-mode justify-content-between mb-3">
                    <h3 class="page-title">Withdraw Approved <br> Requests</h3>
                    <div class="d-flex gap-2">
                        <select name="" id="" class="chart-select">
                            <option value="">Q1(First six months)</option>
                            <option value="">Q2(Last six months)</option>
                        </select>
                        <select name="" id="" class="chart-select">
                            <option value="">2023</option>
                            <option value="">2022</option>
                            <option value="">2021</option>
                        </select>
                    </div>
                </div>
                <div class="d-box chart-height">
                    <div id="approved-invoice"> </div>
                </div>
            </div>

            <!---Transaction Pie chart---->
            <div class="col-md-6">
                <div class="flex-mode justify-content-between mb-3">
                    <h3 class="page-title">Declined and Approved <br>Transactions </h3>
                    <div class="d-flex gap-2">
                        <select name="transaction_day" id="" class="chart-select transaction">
                            <option value="">00</option>
                            @for ($i = 1; $i <= 31; $i++)
                                <option value="{{ $i }}"
                                    {{ request()->transaction_day == $i ? 'selected' : '' }}>
                                    {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                        <select name="transaction_month" id="" class="chart-select transaction">
                            <option value="">Month</option>
                            <option value="Jan" {{ request()->transaction_month == 'Jan' ? 'selected' : '' }}>Jan
                            </option>
                            <option value="Feb" {{ request()->transaction_month == 'Feb' ? 'selected' : '' }}>Feb
                            </option>
                            <option value="Mar" {{ request()->transaction_month == 'Mar' ? 'selected' : '' }}>Mar
                            </option>
                            <option value="Apr" {{ request()->transaction_month == 'Apr' ? 'selected' : '' }}>Apr
                            </option>
                            <option value="May" {{ request()->transaction_month == 'May' ? 'selected' : '' }}>May
                            </option>
                            <option value="Jun" {{ request()->transaction_month == 'Jun' ? 'selected' : '' }}>Jun
                            </option>
                            <option value="Jul" {{ request()->transaction_month == 'Jul' ? 'selected' : '' }}>Jul
                            </option>
                            <option value="Aug" {{ request()->transaction_month == 'Aug' ? 'selected' : '' }}>Aug
                            </option>
                            <option value="Sep" {{ request()->transaction_month == 'Sep' ? 'selected' : '' }}>Sep
                            </option>
                            <option value="Oct" {{ request()->transaction_month == 'Oct' ? 'selected' : '' }}>Oct
                            </option>
                            <option value="Nov" {{ request()->transaction_month == 'Nov' ? 'selected' : '' }}>Nov
                            </option>
                            <option value="Dec" {{ request()->transaction_month == 'Dec' ? 'selected' : '' }}>Dec
                            </option>
                        </select>
                        <select name="transaction_year" id="" class="chart-select transaction">
                            <option value="">Year</option>
                            <option value="2023" {{ request()->transaction_year == '2023' ? 'selected' : '' }}>2023
                            </option>
                            <option value="2022" {{ request()->transaction_year == '2022' ? 'selected' : '' }}>2022
                            </option>
                            <option value="2021" {{ request()->transaction_year == '2021' ? 'selected' : '' }}>2021
                            </option>
                        </select>
                    </div>
                </div>
                <div class="d-box chart-height">
                    <div id="transaction-chart"> </div>
                </div>
            </div>

            <!---Transaction Payment Methods---->
            <div class="col-md-6">
                <div class="flex-mode justify-content-between mb-3">
                    <h3 class="page-title">Transactions <br>Payment Methods</h3>
                    <div class="d-flex gap-2">
                        <select name="payment_method_day" id="" class="chart-select transaction">
                            <option value="">00</option>
                            @for ($i = 1; $i <= 31; $i++)
                                <option value="{{ $i }}"
                                    {{ request()->payment_method_day == $i ? 'selected' : '' }}>
                                    {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                        <select name="payment_method_month" id="" class="chart-select transaction">
                            <option value="">Month</option>
                            <option value="Jan" {{ request()->payment_method_month == 'Jan' ? 'selected' : '' }}>Jan
                            </option>
                            <option value="Feb" {{ request()->payment_method_month == 'Feb' ? 'selected' : '' }}>Feb
                            </option>
                            <option value="Mar" {{ request()->payment_method_month == 'Mar' ? 'selected' : '' }}>Mar
                            </option>
                            <option value="Apr" {{ request()->payment_method_month == 'Apr' ? 'selected' : '' }}>Apr
                            </option>
                            <option value="May" {{ request()->payment_method_month == 'May' ? 'selected' : '' }}>May
                            </option>
                            <option value="Jun" {{ request()->payment_method_month == 'Jun' ? 'selected' : '' }}>Jun
                            </option>
                            <option value="Jul" {{ request()->payment_method_month == 'Jul' ? 'selected' : '' }}>Jul
                            </option>
                            <option value="Aug" {{ request()->payment_method_month == 'Aug' ? 'selected' : '' }}>Aug
                            </option>
                            <option value="Sep" {{ request()->payment_method_month == 'Sep' ? 'selected' : '' }}>Sep
                            </option>
                            <option value="Oct" {{ request()->payment_method_month == 'Oct' ? 'selected' : '' }}>Oct
                            </option>
                            <option value="Nov" {{ request()->payment_method_month == 'Nov' ? 'selected' : '' }}>Nov
                            </option>
                            <option value="Dec" {{ request()->payment_method_month == 'Dec' ? 'selected' : '' }}>Dec
                            </option>
                        </select>
                        <select name="payment_method_year" id="" class="chart-select transaction">
                            <option value="">Year</option>
                            <option value="2023" {{ request()->payment_method_year == '2023' ? 'selected' : '' }}>2023
                            </option>
                            <option value="2022" {{ request()->payment_method_year == '2022' ? 'selected' : '' }}>2022
                            </option>
                            <option value="2021" {{ request()->payment_method_year == '2021' ? 'selected' : '' }}>2021
                            </option>
                        </select>

                    </div>
                </div>
                <div class="d-box chart-height">
                    <div id="payment-method-chart"> </div>
                </div>
            </div>
        </div>
    </form>

@endsection
@push('js')
    <script src="{{ asset('backend/js/apexcharts.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.transaction').change(function() {
                $('#payment_filter').submit();
            });
        });
        var options = {
            series: [{
                    name: 'Total Invoices',
                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                }, {
                    name: 'Paid Invoices',
                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                }, {
                    name: 'Pending Invoices',
                    data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                },
                {
                    name: 'Expired Invoices',
                    data: [75, 12, 86, 26, 43, 48, 42, 50, 41]
                }
            ],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '36%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            yaxis: {
                title: {
                    text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val
                    }
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        //  Pending Invoice
        var pendingInvoice = {
            series: [{
                name: 'Pending Request',
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
            }],
            colors: ['rgb(138, 213, 255)'],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '25%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            yaxis: {
                title: {
                    text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " thousands"
                    }
                }
            }
        };
        var chartPending = new ApexCharts(document.querySelector("#pending-invoice"), pendingInvoice);
        chartPending.render();

        // Approved Invoice

        var option = {
            series: [{
                name: 'Expired Invoices',
                data: [75, 12, 86, 26, 43, 48, 42, 50, 41]
            }],
            colors: ['rgb(167, 227, 180)'],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '36%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            yaxis: {
                title: {
                    text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val
                    }
                }
            }
        };

        var chartApproved = new ApexCharts(document.querySelector("#approved-invoice"), option);
        chartApproved.render();

        var transaction_options = {
            series: {!! json_encode($transactionsCount['total']) !!},
            chart: {
                width: 500,
                type: 'pie',
            },
            labels: {!! json_encode($transactionsCount['status']) !!},
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 300
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var transaction_chart = new ApexCharts(document.querySelector("#transaction-chart"), transaction_options);
        transaction_chart.render();

        var payment_method_options = {
            series: [{
                name: 'Payment Method',
                data: {!! json_encode($paymentMethodCount['total']) !!}
            }],
            chart: {
                height: 350,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val;
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },

            xaxis: {
                categories: {!! json_encode($paymentMethodCount['name']) !!},
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function(val) {
                        return val + "%";
                    }
                }

            },
            title: {
                text: 'Payment Methods',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#444'
                }
            }
        };

        var payment_method_chart = new ApexCharts(document.querySelector("#payment-method-chart"), payment_method_options);
        payment_method_chart.render();
    </script>
@endpush
