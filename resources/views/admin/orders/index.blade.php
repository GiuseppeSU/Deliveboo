@extends('layouts.app')








@section('content')
<div class="container" id="cont-wrap">
    <h2 class="fs-4 text-center my-4">
        {{ __('Ordini') }}
    </h2>
    <br>
<div class="row justify-content-center ">
    <div class="col-lg-4 col-md-12 col-sm-12 mb-5">
        @include('partials.sidebar')
    </div>
    <div class="col-lg-8 col-md-12 col-sm-12">
        <div id="container_index">
        <div class="">
            <div class="container_general overflow-hidden col-12 rounded-4">
                <table class="text-center w-100 ">
                    <thead>
                        <tr class="mb-3">
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
                            <tr class="p-5">
                                <th scope="row" class="text-break"> {{ $order->order_code }} </th>
                                <td>&euro; {{ $order->total }} </td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->status }}</td>
                                <td class="actions">
                                    <a href="{{ route('admin.orders.edit', ['order' => $order->order_code]) }}"
                                        class='btn btn-outline-warning p-1'><i
                                            class="mx-1 fa-solid fa-pen-to-square"></i></a>
                                    <a
                                        href="{{ route('admin.orders.show', $order) }}"class='btn btn-outline-primary p-1 px-2'><i
                                            class="mx-1 fa-solid fa-info "></i></a>
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
        </div>
    </div>


</div>



        <div class="d-flex justify-content-center" id="torna_indietro">
            <a href="{{ url('admin') }}" class="btn btn-primary">Torna indietro</a>
        </div>

    </div>
@endsection
