@extends('backend.layouts.app')
@section('title', 'Add Service')
@section('content')
    <div class="row">
        <form action="{{ route('admin.bank-service.store', ['bank' => $bank]) }}" method="post">
            <div class="card">
                <div class="card-header">
                    Add Service
                </div>

                <div class="card-body">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="">Service name:</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn btn-theme-effect mt-2" type="submit">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
