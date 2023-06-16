
@extends('layouts.app')
@section('content')

<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Lista dei piatti') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col-3">
            @include('partials.sidebar')
        </div>
        <div class="col-9">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID_ristorante</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Prezzo</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{$product->restaurant_id}}</td>
                        <td>{{$product->name}}</td>
                        <td>€ {{$product->price}}</td>
                        <td>{{$product->category}}</td>
                        <td>
                            <a href=""><i class="mx-2 fa-solid fa-trash-can"></i></a>
                            <a href="{{ route('admin.products.show', $product) }}"><i class="mx-2 fa-solid fa-info"></i></a>
                            <a href=""><i class="mx-2 fa-solid fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
