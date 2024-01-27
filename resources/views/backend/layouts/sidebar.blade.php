<div class="sticky-top">
    <div class="logo-container">
        <img height="38" class="logo-full" id="logo" src="{{asset('images/addispay-logo.png')}}" alt="">
        <img class="logo-icon" id="logo" src="{{asset('images/addispay-logo-icon.png')}}" alt="">
    </div>
    <a href="{{route(\App\Helpers\GeneralHelper::WHO_AM_I().'.index')}}" class="s-links dashboard" id="dashboard">
        <img width='18' src="{{asset('images/icons/dashboard.svg')}}" alt="">
        <span> {{ __('Dashboard') }} </span>
    </a>
</div>
<div class="sidebar-content">
    <ul class="nav d-flex flex-column">
        @role(\App\Helpers\IUserRole::CUSTOMER_ROLE)
            <li class="nav-item">
                <a class="nav-link s-links {{ Request::is('customer/ledger') ? 'active' : '' }}"
                   href="{{ route(\App\Helpers\IUserRole::CUSTOMER_ROLE.'.ledger.index') }}">
                    <img width='18' src="{{asset('images/icons/customers.svg')}}" alt="">
                    <span>{{ __('Ledger') }}</span>
                </a>
            </li>
        @endrole
        @role(\App\Helpers\IUserRole::ADMIN_ROLE)
        <li class="nav-item position-relative" id="merchant-link">
            <a class="nav-link s-links collapsed {{ Request::is('admin/merchant*') ? 'active' : '' }} " href="#merchant"
               aria-expanded="true" aria-current="page"
               data-bs-toggle="collapse" aria-controls="merchant">
                <img width='18' src="{{asset('images/icons/merchant_icon.svg')}}" alt="">
                <span>{{ __('Merchants') }}</span>
            </a>
            <div class="collapse {{ Request::is('admin/merchant*') ? 'show' : '' }}" id="merchant">
                <ul class="nav inner-menu">
                    <li>
                        <a href="{{ route(\App\Helpers\IUserRole::ADMIN_ROLE.'.merchants.index') }}"
                           class="{{ Request::is('admin/merchants') ? 'active' : '' }}">{{ __('All Merchant') }}</a>
                    </li>
                    <li>
                        <a href="{{ route(\App\Helpers\IUserRole::ADMIN_ROLE.'.merchants.create') }}"
                           class="{{ Request::is('admin/merchants/create-merchant') ? 'active' : '' }}">{{ __('Create Merchant') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        @endrole

        @role(\App\Helpers\IUserRole::MERCHANT_ROLE)
            <li class="nav-item">
                <a class="nav-link s-links" href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.epos') }}">
                    <img width='18' src="{{asset('images/icons/gateways.svg')}}" alt="">
                    <span>{{ __('E-Pos') }}</span>
                </a>
            </li>
            <li class="nav-item position-relative" id="merchant-link">
                <a class="nav-link s-links collapsed {{ Request::is('merchant/invoices*') ? 'active' : '' }} "
                   href="#merchant" aria-expanded="true" aria-current="page"
                   data-bs-toggle="collapse" aria-controls="merchant">
                    <img width='18' src="{{asset('images/icons/merchant_icon.svg')}}" alt="">
                    <span>{{ __('External Requests') }}</span>
                </a>
                <div class="collapse {{ Request::is('merchant/invoices*') ? 'show' : '' }}" id="merchant">
                    <ul class="nav inner-menu">
                        <li>
                            <a href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.invoices.index') }}"
                               class="{{ Request::is('merchant/invoices') ? 'active' : '' }}">{{ __('All External Reqs') }}</a>
                        </li>
                        <li>
                            <a href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.invoices.form') }}"
                               class="{{ Request::is('merchant/invoices-create') ? 'active' : '' }}">{{ __('Create Requests') }}</a>
                        </li>
                        <li>
                            <a href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.invoice.refund.request') }}"
                               class="{{ Request::is('merchant/invoices/refund-request') ? 'active' : '' }}">{{ __('Refund Request') }}</a>
                        </li>
                    </ul>
                </div>
            </li>
            @if(\App\Helpers\GeneralHelper::USER()->is_school == true)
            <li class="nav-item">
                <a class="nav-link s-links" href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.students.index') }}">
                    <img width='18' src="{{asset('images/icons/customers.svg')}}" alt="">
                    <span>{{ __('Students') }}</span>
                </a>
            </li>
            @else
                <li class="nav-item">
                    <a class="nav-link s-links {{ Request::is('merchant/customers*') || Request::is('merchant/create-customer') ? 'active' : '' }}"
                       href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.customers.index') }}">
                        <img width='18' src="{{asset('images/icons/customers.svg')}}" alt="">
                        <span>{{ __('Customers') }}</span>
                    </a>
                </li>
            @endif
        @endrole
        @role(\App\Helpers\IUserRole::MERCHANT_ROLE)
            <li class="nav-item">
                <a class="nav-link s-links" href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.gateway.index') }}">
                    <img width='18' src="{{asset('images/icons/gateways.svg')}}" alt="">
                    <span>{{ __('Gateways') }}</span>
                </a>
            </li>
        @endrole
        @role(\App\Helpers\IUserRole::MERCHANT_ROLE)
            <li class="nav-item">
                <a class="nav-link s-links" href="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE.'.transactions.index') }}">
                    <img width='18' src="{{asset('images/icons/ledger.svg')}}" alt="">
                    <span>{{ __('Ledgers') }}</span>
                </a>
            </li>
        @endrole
        @role(\App\Helpers\IUserRole::ADMIN_ROLE)
        <li class="nav-item position-relative" id="merchant-link">
            <a class="nav-link s-links collapsed {{ Request::is('admin/customers*') ? 'active' : '' }} " href="#customers"
               aria-expanded="true" aria-current="page"
               data-bs-toggle="collapse" aria-controls="merchant">
                <img width='18' src="{{asset('images/icons/customers.svg')}}" alt="">
                <span>{{ __('Customers') }}</span>
            </a>
            <div class="collapse {{ Request::is('admin/customers*') ? 'show' : '' }}" id="customers">
                <ul class="nav inner-menu">
                    <li>
                        <a href="{{ route(\App\Helpers\IUserRole::ADMIN_ROLE.'.customers.index') }}"
                           class="{{ Request::is('admin/customers') ? 'active' : '' }}">{{ __('All Customers') }}</a>
                    </li>
                    <li>
                        <a href="{{ route(\App\Helpers\IUserRole::ADMIN_ROLE.'.customers.create') }}"
                           class="{{ Request::is('admin/customers/create-customer') ? 'active' : '' }}">{{ __('Create Customer') }}</a>
                    </li>
                </ul>
            </div>
        </li>
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link s-links {{ Request::is('admin/customers*') ? 'active' : '' }}"--}}
{{--               href="{{ route(\App\Helpers\IUserRole::ADMIN_ROLE.'.customers.index') }}">--}}
{{--                <img width='18' src="{{asset('images/icons/customers.svg')}}" alt="">--}}
{{--                <span>{{ __("Customers") }}</span>--}}
{{--            </a>--}}
{{--        </li>--}}
        @endrole
        @role(\App\Helpers\IUserRole::ADMIN_ROLE)
        <li class="nav-item position-relative" id="approval-link">
            <a class="nav-link s-links collapsed {{ Request::is('admin/pending*') ? 'active' : '' }} " href="#approval"
               aria-expanded="true" aria-current="page"
               data-bs-toggle="collapse" aria-controls="approval">
                <img width='18' src="{{asset('images/icons/merchant_icon.svg')}}" alt="">
                <span>{{ __('Document Approval') }}</span>
            </a>
            <div class="collapse {{ Request::is('admin/pending*') ? 'show' : '' }}" id="approval">
                <ul class="nav inner-menu">
                    <li>
                        <a href="{{ route(\App\Helpers\IUserRole::ADMIN_ROLE.'.merchant.documents.index') }}"
                           class="{{ Request::is('admin/pending-merchants') ? 'active' : '' }}">{{ __('Pending Merchant') }}</a>
                    </li>
                    <li>
                        <a href="{{ route(\App\Helpers\IUserRole::ADMIN_ROLE.'.customer.documents.index') }}"
                           class="{{ Request::is('admin/pending-customers') ? 'active' : '' }}">{{ __('Pending Customer') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        @endrole
        @role(\App\Helpers\IUserRole::ADMIN_ROLE)
            <li class="nav-item position-relative" id="approval-link">
                <a class="nav-link s-links collapsed {{ Request::is('admin/gateways*') ? 'active' : '' }} " href="#gateway"
                   aria-expanded="true" aria-current="page"
                   data-bs-toggle="collapse" aria-controls="approval">
                    <img width='18' src="{{asset('images/icons/gateways.svg')}}" alt="">
                    <span>{{ __('Gateways') }}</span>
                </a>
                <div class="collapse {{ Request::is('admin/gateways*') ? 'show' : '' }}" id="gateway">
                    <ul class="nav inner-menu">
                        <li>
                            <a href="{{ route(\App\Helpers\IUserRole::ADMIN_ROLE.'.gateways.index') }}"
                               class="{{ Request::is('admin/gateways') ? 'active' : '' }}">{{ __('Payment Gateways') }}</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endrole
        @role(\App\Helpers\IUserRole::ADMIN_ROLE)
        <li class="nav-item">
            <a class="nav-link s-links {{ Request::is('admin/payments*') ? 'active' : '' }}" href="#">
                <img width='18' src="{{asset('images/icons/payments.svg')}}" alt="">
                <span>{{ __('Payments') }}</span>
            </a>
        </li>
        @endrole
        @role(\App\Helpers\IUserRole::ADMIN_ROLE)
        <li class="nav-item">
            <a class="nav-link s-links collapsed" href="#merchant-fee" aria-expanded="true" data-bs-toggle="collapse">
                <img width='18' src="{{asset('images/icons/merchant-fee.svg')}}" alt="">
                <span>{{ __('Merchant Fee') }}</span>
            </a>
            <div class="collapse" id="merchant-fee">
                <ul class="nav inner-menu">
                    <li>
                        <a href="">{{ __("View Commission's") }}</a>
                    </li>
                    <li>
                        <a href="">{{ __('Set Commission') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        @endrole
        @if(Auth::user()->hasAnyPermission(['reports_read','reports_delete']))
            <li class="nav-item">
                <a class="nav-link s-links collapsed" href="#reports" aria-expanded="true" data-bs-toggle="collapse">
                    <img width='18' src="{{asset('images/icons/reports.svg')}}" alt="">
                    <span>{{ __('Reports') }}</span>
                </a>
                <div class="collapse" id="reports">
                    <ul class="nav inner-menu">
                        <li>
                            <a href="">{{ __('Payment Reports') }}</a>
                        </li>
                        <li>
                            <a href="">{{ __('Merchant Reports') }}</a>
                        </li>
                        <li>
                            <a href="">{{ __('Invoice Reports') }}</a>
                        </li>
                        <li>
                            <a href="">{{ __('Withdrawl Reports') }}</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
        @role(\App\Helpers\IUserRole::ADMIN_ROLE)
        <li class="nav-item">
            <a class="nav-link s-links" href="{{ route('admin.transactions.index') }}">
                <img width='18' src="{{asset('images/icons/ledger.svg')}}" alt="">
                <span> Ledgers </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link s-links {{ Request::is('admin/customer-ledgers') ? 'active' : '' }}" href="{{ route('admin.ledgers.customer') }}">
                <img width='18' src="{{asset('images/icons/ledger.svg')}}" alt="">
                <span> Customer Ledgers </span>
            </a>
        </li>
        @endrole
        @if(Auth::user()->hasAnyPermission(['bank_create','bank_edit','bank_read','bank_delete','bank_list']))
            <li class="nav-item">
                <a class="nav-link s-links" href="{{ route('admin.banks.index') }}">
                    <img width='18' src="{{asset('images/icons/bank.svg')}}" alt="">
                    <span> Banks</span>
                </a>
            </li>
        @endif
        @role(\App\Helpers\IUserRole::ADMIN_ROLE)
        <li class="nav-item">
            <a class="nav-link s-links collapsed" href="{{ route('admin.currency.index') }}" >
                <img width='18' src="{{asset('images/icons/currency.svg')}}" alt="">
                <span>{{ __('Currency') }}</span>
            </a>
        </li>
        @endrole
        @if(Auth::user()->hasAnyPermission(['withdrawal_request_create','withdrawal_request_edit','withdrawal_request_view','withdrawal_request_delete']))
            <li class="nav-item">
                <a class="nav-link s-links" href="#">
                    <img width='18' src="{{asset('images/icons/withdrawal-request.svg')}}" alt="">
                    <span>{{ __("Withdrawal Request's") }}</span>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link s-links" href="#">
                <img width='18' src="{{asset('images/icons/support.svg')}}" alt="">
                <span>{{ __('Support') }}</span>
            </a>
        </li>
        @role(\App\Helpers\IUserRole::ADMIN_ROLE)
        <li class="nav-item">
            <a class="nav-link s-links collapsed" href="#" aria-expanded="true" data-bs-toggle="collapse">
                <img width='18' src="{{asset('images/icons/admin-and-roles.svg')}}" alt="">
                <span> Admin & Roles </span>
            </a>
        </li>
        @endrole
        @role(\App\Helpers\IUserRole::MERCHANT_ROLE)
        <li class="nav-item">
            <a class="nav-link s-links collapsed" href="#" aria-expanded="true" data-bs-toggle="collapse">
                <img width='18' src="{{asset('images/icons/setting-icon.svg')}}" alt="">
                <span>{{__('Settings')}}</span>
            </a>
        </li>
        @endrole
        @if(Auth::user()->hasAnyPermission(['theme_read','theme_create','theme_edit','theme_delete']))
            <li class="nav-item">
                <a class="nav-link s-links collapsed" href="#" aria-expanded="true" data-bs-toggle="collapse">
                    <img width='18' src="{{asset('images/icons/frontend-icon.svg')}}" alt="">
                    <span>{{ __('Frontend Settings') }}</span>
                </a>
            </li>
        @endif
        @if(Auth::user()->hasAnyPermission(['logs_read']))
            <li class="nav-item">
                <a class="nav-link s-links collapsed {{ Request::is('admin/logs*') ? 'active' : '' }}"
                href="{{ route( App\Helpers\IUserRole::ADMIN_ROLE.'.logs' ) }}" aria-expanded="true">
                 <img width='18' src="{{asset('images/icons/logs.svg')}}" alt="">
                 <span>{!! __('System Logs') !!}</span>
             </a>
            </li>
        @endif
    </ul>
</div>


