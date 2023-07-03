@extends('layouts.stats')

@section('content')
    <div class="container">
        <div class="row col-2">
            <select class="form-select" name="year" id="year">
                <option value="0" selected>Scegli Un Anno</option>
                <option value="2022">Ordini 2022</option>
                <option value="2023">Ordini 2023</option>
            </select>
        </div>
        <div class="row col-10 mx-auto">
            <div class="h-75" id="containerCanvas">
                <canvas id="myCountChart" data-orders2022='@json($total_orders_2022)' data-orders2023='@json($total_orders_2023)'></canvas>
            </div>
        </div>
        <div class="row col-10 mx-auto">
            <div class="h-75">
                <canvas id="myTotalChart" ></canvas>
            </div>
        </div>
        
    </div>
@endsection
