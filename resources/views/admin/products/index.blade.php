
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
                            <a href="{{ route('admin.products.edit', ['product' => $product->slug])}}" class='btn btn-outline-warning p-1'><i class="mx-1 fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('admin.products.show', $product) }}"class='btn btn-outline-primary p-1 px-2'><i class="mx-1 fa-solid fa-info"></i></a>
                            <form class="form_delete_product d-inline-block" action="{{route('admin.products.destroy', ['product' => $product->slug])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class='btn btn-outline-danger p-1'><i class="mx-1 fa-solid fa-trash-can"></i></button>

                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

                <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Conferma eliminazione</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Confermi di voler eliminare l'elemento selezionato?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chudi</button>
                                <button type="button" class="btn btn-danger">Conferma eliminazione</button>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>

@endsection
