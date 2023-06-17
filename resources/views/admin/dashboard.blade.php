@extends('layouts.app')

@section('content')
<div class="container ">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col-3">
            @include('partials.sidebar')
        </div>
        <div class="col-9">
            <div class="card ">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            <br>
            <div class="card w-25">
                <h6 class="card-header text-center">Numero di piatti</h6>
                <h1 class="text-center">
                <a href="{{ route('admin.products.index') }}" class="nav-link link-body-emphasis">
                    {{$products->count()}}
</a>
                </h1>
            </div>
        </div>
    </div>
</div>
@endsection
