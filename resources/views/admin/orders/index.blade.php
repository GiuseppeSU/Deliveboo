@extends('layouts.nav')

@section('content')

    <div class="container bg-light rounded-2 p-2 overflow-hidden">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Codice Ordine</th>
                    <th scope="col">Total</th>
                    <th scope="col">Data</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <th scope="row"> {{$order->order_code}} </th>
                        <td>{{$order->total}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->status}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- <ul class="list-group list-group-flush">

            @foreach ($order->products as $product)
                <li class="list-group-item d-inline-block d-flex ">{{ $product->name }}<span
                        class="ms-auto">{{ $product->pivot->quantity }}</span></li>
            @endforeach

        </ul> --}}

    </div>
@endsection
