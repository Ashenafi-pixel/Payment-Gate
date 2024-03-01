@extends('backend.layouts.app')
@section('title', 'Edit Service')
@section('content')
    <div class="row">
        <form action="{{ route('admin.bank-service.update', ['bank' => $bank, 'bank_service'=>$bankService]) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="card">
                <div class="card-header">
                    Edit Service
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="">Service name:</label>
                            <input type="text" class="form-control" name="name" value="{{ $bankService->name }}">
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn btn-theme-effect mt-2" type="submit">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
