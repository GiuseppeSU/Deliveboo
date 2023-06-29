@extends('layouts.nav')
@section('content')
    <div id="container_show">
        <div class="container container_general mb-5">
            <div class="d-flex justify-content-center mt-5">
                <div class="card_general w-25">
                    <img src={{ asset('storage/' . $product->image) }} class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3">{{ $product->name }}</h5>
                        <p class="card-text text-center">{{ $product->description }}</p>
                        <p class="text-center">{{ $product->price }}</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('admin.products.index') }}" class="button_my">Torna indietro</a>
                        </div>

                    </div>
                </div>

            </div>


        </div>
    </div>
@endsection
