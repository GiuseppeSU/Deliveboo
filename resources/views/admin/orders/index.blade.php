@extends('layouts.app')

@section('content')
<div class="container">
@foreach($orders as $order )
    
    <div class="card col-2">
        <div class="card-body">
            <h5 class="card-title">Ordine di {{$order->name}}</h5>
            <p class="card-text">Indirizzo: {{$order->address}}</p>
            <p>Totale: {{$order->total}}</p>
        </div>

        <ul class="list-group list-group-flush">

        @foreach ($order->products as $product)
        
            <li class="list-group-item d-inline-block d-flex ">{{$product->name}}<span class="ms-auto">{{$product->pivot->quantity}}</span></li>
        
        @endforeach

        </ul>

        @endforeach
    </div>

</div>

@endsection