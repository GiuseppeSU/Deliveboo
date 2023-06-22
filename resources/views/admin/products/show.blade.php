@extends('layouts.nav')
@section('content')
    <div class="container mb-5">
        <div class="d-flex justify-content-center mt-5">
            <div class="card w-25">
                <img src={{ asset('storage/'.$product->image)}} class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <p>{{ $product->price }}</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Torna indietro</a>
                </div>
            </div>

        </div>


    </div>
@endsection
