@extends('backend.layouts.app')
@section('title', 'All Banks')
@section('content')
    <div class="row">
        <form action="{{ route('admin.banks.update', ['bank' => $bank]) }}" method="post">
            <div class="card">
                <div class="card-header">
                    Edit Bank Detail
                </div>

                <div class="card-body">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="">Bank name:</label>
                            <input type="text" class="form-control" name="name" value="{{ $bank->name }}">
                        </div>

                        <div class="col-md-6">
                            <label for="">Swift code:</label>
                            <input type="text" class="form-control" name="swift_code" value="{{ $bank->swift_code }}">
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
