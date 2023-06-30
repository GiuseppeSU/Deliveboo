@extends('layouts.nav')
@section('content')
    <div id="container_dish">
        <div class="container">
            <h2 class="fs-4 text-center my-4">
                {{ __('Lista dei piatti') }}
            </h2>
            <br>
            <div class="row justify-content-center ">
                <div class="col-lg-4 col-md-12 col-sm-12 mb-5">
                    @include('partials.sidebar')
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 container_general p-3 rounded-4">
                    <table class="text-center w-100 ">
                        <thead>
                            <tr class="mb-3">
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Prezzo</th>
                                <th scope="col">Visibilità piatto</th>
                                <!-- <th scope="col">Categoria</th>-->
                                <th scope="col">Azioni</th>
                            </tr>
                        </thead>

                        <tbody class="p-5">
                            @foreach ($products as $key => $product)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>€ {{ $product->price }}</td>
                                    <td>{{ $product->visibility ? 'si' : 'no' }}</td>
                                    <!--  <td>{{ $product->category }}</td>-->
                                    <td>
                                        <a href="{{ route('admin.products.edit', ['product' => $product->slug]) }}"
                                            class='btn btn-outline-warning p-1'><i
                                                class="mx-1 fa-solid fa-pen-to-square"></i></a>
                                        <a
                                            href="{{ route('admin.products.show', $product) }}"class='btn btn-outline-primary p-1 px-2'><i
                                                class="mx-1 fa-solid fa-info"></i></a>
                                        <form class="form_delete_product d-inline-block"
                                            action="{{ route('admin.products.destroy', ['product' => $product->slug]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class='btn btn-outline-danger p-1'><i
                                                    class="mx-1 fa-solid fa-trash-can"></i></button>

                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Conferma eliminazione</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
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
    </div>
@endsection
