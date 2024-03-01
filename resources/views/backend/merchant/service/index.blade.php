@extends('backend.layouts.app')
@section('title', 'All Your Services')
@section('content')
    <h1>Services for User: {{ $user->name }}</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form method="post" action="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE . 'user.update-services', $user) }}">
        @csrf
        @method('patch')

        <h2>Select Services:</h2>
        @foreach ($services as $service)
            <div class="form-check">
                <input type="checkbox" name="services[]" value="{{ $service->id }}"
                    {{ $user->services->contains($service->id) ? 'checked' : '' }}>
                <label class="form-check-label" for="service_{{ $service->id }}">
                    {{ $service->name }}
                </label>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary mt-3">Save Services</button>
    </form>
@endsection
