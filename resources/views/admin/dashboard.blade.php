@extends('layouts.nav')

@section('content')
    <div class="container" id="dashboard_cont">
        <h2 class="fs-4 text-center my-4">
            {{ __('Dashboard') }}
        </h2>
        <br>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-12 col-md-12 mb-3">
                @include('partials.sidebar')
            </div>
            <div class="col-lg-8 col-sm-12 col-md-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card rounded-4">
                            <!--<div class="card-header">{{ __('User Dashboard') }}</div>-->

                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <strong>
                                    {{ __('Benvenuto nella tua area personale') }}
                                </strong>
                            </div>
                        </div>
                    </div>

                </div>


                <br>

                <div class="row">
                    <div class="col-6">
                        <div class="card rounded-4 simple-card">
                            <h6 class="card-header text-center">
                                <strong>
                                    Numero di piatti
                                </strong>
                            </h6>
                            <h1 class="d-flex align-items-center justify-content-center">
                                <a href="{{ route('admin.products.index') }}" class="nav-link link-body-emphasis">
                                    {{ $products }}
                                </a>
                            </h1>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card rounded-4 simple-card">
                            <h6 class="card-header text-center">
                                <strong>
                                    Numero degli ordini
                                </strong>
                            </h6>
                            <h1 class="d-flex align-items-center justify-content-center">
                                <a href="{{ route('admin.orders.index') }}" class="nav-link link-body-emphasis">
                                    {{ $orders }}
                                </a>
                            </h1>
                        </div>
                    </div>
                </div>
                <br>



            </div>
        </div>
    </div>
@endsection
