@extends('backend.layouts.app')
@section('title',__('Documents'))
@section('content')

<h3 class="page-title mb-3">{{ __('Documents') }}</h3>
{!! Form::open(['url' => route(\App\Helpers\IUserRole::ADMIN_ROLE.'.approve.document',['type' => 'customer']),'class' => 'ajax']) !!}
<div class="row gy-4">
    <div class="col-lg-4 card-border">
        <div class="card document">
            <div class="card-header text-center">
                <h3 class="sub-title mb-0">{{ __('CNIC') }}</h3>
            </div>
            <input type="hidden" name="user_id" value="{{ encrypt($documents->user_id) }}">
            @if(pathinfo($documents->document_detail->cnic_doc, PATHINFO_EXTENSION) == \App\Helpers\IDocTypes::PDF)
                <div class="card-body mh-185 p-0">
                    <iframe width="100%" height="185" src="{{asset($documents->document_detail->cnic_doc)}}"
                            frameborder="0"></iframe>
                </div>
            @else
                <div class="card-body p-0 mh-185 text-center">
                    <img class="img-fluid" src="{{asset($documents->document_detail->cnic_doc)}}" alt="">
                </div>
            @endif
            <div class="card-footer text-end p-2">
                <div class="row">
                    <div class="col-12 text-center">
                        <input type="radio" value="{{ \App\Helpers\IStatuses::APPROVED }}" class="btn-check" name="cnic_doc" id="success-outlined" autocomplete="off" @if($documents->document_detail->cnic_doc_status == \App\Helpers\IStatuses::APPROVED) checked @endif>
                        <label class="btn btn-outline-success box-shadow-0" for="success-outlined">Approved</label>

                        <input type="radio" value="{{ \App\Helpers\IStatuses::REJECTED }}" class="btn-check" name="cnic_doc" id="danger-outlined" autocomplete="off" @if($documents->document_detail->cnic_doc_status == \App\Helpers\IStatuses::REJECTED) checked @endif>
                        <label class="btn btn-outline-danger box-shadow-0" for="danger-outlined">Rejected</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 card-border">
        <div class="card document">
            <div class="card-header text-center">
                <h3 class="sub-title mb-0">{{ __('LICENSE') }}</h3>
            </div>
            @if(pathinfo($documents->document_detail->license_doc, PATHINFO_EXTENSION) == \App\Helpers\IDocTypes::PDF)
                <div class="card-body p-0 mh-185">
                    <iframe width="100%" height="185" src="{{asset($documents->document_detail->license_doc)}}"
                            frameborder="0"></iframe>
                </div>
            @else
                <div class="card-body p-0 mh-185 text-center">
                    <img class="img-fluid" src="{{asset($documents->document_detail->license_doc)}}" alt="">
                </div>
            @endif
            <div class="card-footer text-end p-2">
                <div class="row">
                    <div class="col-12 text-center">
                        <input type="radio" class="btn-check" value="{{ \App\Helpers\IStatuses::APPROVED }}" name="license_doc" id="approve-pdf" autocomplete="off" @if($documents->document_detail->license_doc_status == \App\Helpers\IStatuses::APPROVED) checked @endif>
                        <label class="btn btn-outline-success box-shadow-0" for="approve-pdf">Approved</label>

                    <input type="radio" class="btn-check" value="{{ \App\Helpers\IStatuses::REJECTED }}" name="license_doc" id="reject-pdf" autocomplete="off" @if($documents->document_detail->license_doc_status == \App\Helpers\IStatuses::REJECTED) checked @endif>
                    <label class="btn btn-outline-danger box-shadow-0" for="reject-pdf">Rejected</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 text-end">
        <a class="btn btn-secondary me-2" href="{{ url()->previous() }}">
            <div class="flex-mode gap-2">
                <span class="material-symbols-outlined">
                    arrow_back
                    </span>
                {{__('Back')}}
            </div>
        </a>
        <button type="submit" class="btn btn-theme">
            <div class="flex-mode gap-2">
                <span class="material-symbols-outlined">
                    update
                </span>
                {{__('Update')}}
            </div>
        </button>
    </div>
</div>
{!! Form::close() !!}
@endsection
