@extends('layouts.nav')
@section('content')
    <div class="container" id="order_show_cont">
        <div class="row row-cols-1 row-cols-md-2">
            <ul class="list-group my-2">
                <li class="list-group-item">
                    <h3 class="text-center">Dati del cliente</h3>
                </li>
                <li class="list-group-item">
                    <strong>Codice Ordine:</strong>
                    <span>{{ $order->order_code }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Totale:</strong>
                    <span>{{ $order->total }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Email:</strong>
                    <span>{{ $order->email }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Nome:</strong>
                    <span>{{ $order->name }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Indirizzo:</strong>
                    <span>{{ $order->address }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Numero di telefono:</strong>
                    <span>{{ $order->phone_number }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Data:</strong>
                    <span>{{ $order->created_at }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Status:</strong>
                    <span>{{ $order->status }}</span>
                </li>
            </ul>

            <ul class="list-group my-2">
                <li class="list-group-item">
                    <h3 class="text-center">Prodotti ordinati</h3>
                </li>
                @foreach ($order->products as $product)
                    <li class="list-group-item">
                        <strong>{{ $product->pivot->quantity}}x</strong>
                        <span>{{ $product->name }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="text-center py-3" id="torna_indietro">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Torna indietro</a>
        </div>
    </div>
@endsection
