@extends('layouts.stats')

@section('content')
    <div class="container">
        <div class="row col-10 mx-auto">
            <div class="h-75">
                <canvas id="myCountChart" data-orders='@json($total_orders)'></canvas>
            </div>
        </div>
        <div class="row col-10 mx-auto">
            <div class="h-75">
                <canvas id="myTotalChart" ></canvas>
            </div>
        </div>
        
    </div>
@endsection
