@extends('backend.layouts.app')
@section('title', 'Add Banks')
@section('content')
    <div class="row">
    <form action="{{ route('admin.banks.store') }}" method="post">

    <div class="card">
                <div class="card-header">
                    Add New Bank
                </div>

                <div class="card-body">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="name">Bank name:</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                        </div>

                        <div class="col-md-6">
                            <label for="swift_code">Swift code:</label>
                            <input type="text" class="form-control" name="swift_code" id="swift_code" value="{{ old('swift_code') }}">
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
