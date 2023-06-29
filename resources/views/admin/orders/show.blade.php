@extends('layouts.nav')
@section('content')
    <div class="container mb-5">
        <div class="d-flex justify-content-center mt-5">
            <div class="card w-25">
                <div class="card-body">
                    <h5 class="card-title">{{ $order->order_code }}</h5>
                    <h6 class="card-text"> &euro; {{ $order->total }}</h6>
                    <p>{{ $order->name }}</p>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Torna indietro</a>
                </div>
            </div>

        </div>


    </div>
@endsection
