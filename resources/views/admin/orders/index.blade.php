@extends('layouts.nav')

@section('content')

    <div class="container bg-light rounded-2 p-2 overflow-hidden">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Codice Ordine</th>
                    <th scope="col">Totale</th>
                    <th scope="col">Data</th>
                    <th scope="col">Status</th>
                    <th scope="col">Azioni</th>
                    {{-- <th scope="col">Prodotti</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <th scope="row"> {{$order->order_code}} </th>
                        <td>&euro; {{$order->total}} </td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->status}}</td>
                        <td>
                            <a href="{{ route('admin.orders.edit', ['order' => $order->order_code]) }}"
                                class='btn btn-outline-warning p-1'><i
                                    class="mx-1 fa-solid fa-pen-to-square"></i></a>
                            <a
                                href="{{ route('admin.orders.show', $order) }}"class='btn btn-outline-primary p-1 px-2'><i
                                    class="mx-1 fa-solid fa-info"></i></a>
                        </td>
                        {{-- <td>
                            <ul class="list-group list-group-flush">

                                @foreach ($order->products as $product)
                                    <li class="list-group-item d-inline-block d-flex ">{{ $product->name }}<span
                                            class="ms-auto">{{ $product->pivot->quantity }}</span></li>
                                @endforeach
                    
                            </ul>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>

        

    </div>
@endsection