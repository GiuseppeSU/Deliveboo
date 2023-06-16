
@extends('layouts.app')
@section('content')
<div class="container justify-content-center">
    <div class="card w-25">
        <img src={{$product->image}} class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{$product->name}}</h5>
          <p class="card-text">{{$product->description}}</p>
          <p>{{$product->price}}</p>
          <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Torna indietro</a>
        </div>
    </div>

</div>



  @endsection





