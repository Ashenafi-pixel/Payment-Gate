@extends('frontend.layouts.app')
@section('title','Customer Support')
@section('content')
    <section class="section-padder">
        <div class="container">
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <form action="{{ route('save.refund.request') }}" method="post" class="">
                    @csrf
                    <div class="mb-3">
                        <label for="invoice" class="form-label">Invoice No.</label>
                        <input type="text" class="form-control" name="invoice_no" id="invoice" placeholder="Invoice Number">
                    </div>
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason</label>
                        <textarea class="form-control" name="reason" id="reason" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
@endsection
