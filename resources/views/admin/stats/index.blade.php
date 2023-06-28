@extends('layouts.stats')

@section('content')
    <div class="container">
        <div class="row row-cols-2 h-100">
            <div class="col">
                <canvas id="myCountChart" data-orders='@json($total_orders)'></canvas>

            </div>
            <div>
                <canvas id="myTotalChart"></canvas>
            </div>
        </div>
    </div>
@endsection
