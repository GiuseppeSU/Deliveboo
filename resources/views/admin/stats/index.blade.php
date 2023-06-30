@extends('layouts.stats')

@section('content')
    <div class="container">
        <select name="year" id="year">
            <option value="2022">Ordini 2022</option>
            <option value="2023">Ordini 2023</option>
        </select>
        <div class="row col-10 mx-auto">
            <div class="h-75">
                <canvas id="myCountChart" data-orders='@json($total_orders_2023)'></canvas>
            </div>
        </div>
        <div class="row col-10 mx-auto">
            <div class="h-75">
                <canvas id="myTotalChart" ></canvas>
            </div>
        </div>
        
    </div>
@endsection
