@extends('backend.layouts.app')
@section('title','Dashboard')
@section('content')
<h1 class="page-title mb-3">Overview</h1>
<div class="row g-4">
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="d-box  ">
            <div class="text-end mb-2">
                <img height="30" class="filter" src="{{asset('images/icons/d-merchant.svg')}}" alt="">
            </div>
            <h3 class="d-heading ">
                <span
                data-purecounter-duration="2.5"
                data-purecounter-end="{{ $totalTransactionsCount }}"
                class="purecounter"
                >{{ $totalTransactionsCount }}</span>
            </h3>
            <img width="34" class='img-loader' src="{{asset('images/loader.gif')}}" alt="">
            <p class="d-text ">Total Transactions</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="d-box  ">
            <div class="text-end mb-2">
                <img height="30" src="{{asset('images/icons/d-rejected-merchant.svg')}}" alt="">
            </div>
            <h3 class="d-heading ">
                <span
                data-purecounter-duration="2.5"
                data-purecounter-end="{{ $totalDebitTransactionsAmount }}"
                class="purecounter"
                >{{ $totalDebitTransactionsAmount }}</span>
            </h3>
            <img width="34" class='img-loader' src="{{asset('images/loader.gif')}}" alt="">
            <p class="d-text ">Total Debit Amount</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="d-box  ">
            <div class="text-end mb-2">
                <img height="30" src="{{asset('images/icons/d-pending-merchant.svg')}}" alt="">
            </div>
            <h3 class="d-heading ">
                <span
                data-purecounter-duration="2.5"
                data-purecounter-end="{{ $totalCreditTransactionsAmount }}"
                class="purecounter"
                >{{ $totalCreditTransactionsAmount }}</span>
            </h3>
            <img width="34" class='img-loader' src="{{asset('images/loader.gif')}}" alt="">
            <p class="d-text ">Total Credit Amount</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="d-box  ">
            <div class="text-end mb-2">
                <img height="30" src="{{asset('images/icons/d-active-merchant.svg')}}" alt="">
            </div>
            <h3 class="d-heading ">
                <span
                data-purecounter-duration="2.5"
                data-purecounter-end="{{ $totalTransactionsAmount }}"
                class="purecounter"
                >{{ $totalTransactionsAmount }}</span>
            </h3>
            <img width="34" class='img-loader' src="{{asset('images/loader.gif')}}" alt="">
            <p class="d-text ">Total Amount</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="d-box  ">
            <div class="text-end mb-2">
                <img height="30" class="filter" src="{{asset('images/icons/d-total-customer.svg')}}" alt="">
            </div>
            <h3 class="d-heading ">
                <span
                data-purecounter-duration="2.5"
                data-purecounter-end="{{ $totalBalance }}"
                class="purecounter"
                >{{ $totalBalance }}</span>
            </h3>
            <img width="34" class='img-loader' src="{{asset('images/loader.gif')}}" alt="">
            <p class="d-text ">Total Balance</p>
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
</div>
@endsection
@push('js')
<script src="{{asset('backend/js/apexcharts.js')}}"></script>
<script>
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
        }],
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
            formatter: function (val) {
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
        colors:['rgb(138, 213, 255)'],
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
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          }
        }
        };
        var chartPending = new ApexCharts(document.querySelector("#pending-invoice"), pendingInvoice);
        chartPending.render();

    // Approved Invoice

        var option = {
      series: [
        {
          name: 'Expired Invoices',
          data: [75, 12, 86, 26, 43, 48, 42, 50, 41]
        }],
        colors:['rgb(167, 227, 180)'],
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
            formatter: function (val) {
              return "$ " + val
            }
          }
        }
        };

        var chartApproved = new ApexCharts(document.querySelector("#approved-invoice"), option);
        chartApproved.render();
</script>
@endpush
