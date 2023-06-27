@extends('layouts.app')

@section('content')

    <div class="container stat-container justify-content-center">
        <div class="row col-10 h-100">
            <div class="h-100 mx-auto">
                <canvas id="myChart" data-info=@json($orders)></canvas>
            </div>
        </div>
    </div>

@endsection