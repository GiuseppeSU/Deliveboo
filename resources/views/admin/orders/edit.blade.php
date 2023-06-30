@extends('layouts.nav')

{{-- @section('page-title', 'Edit Project') --}}

@section('content')
    <div id="container_order_edit" class="container">

        @include('partials.forms.validation.errors_alert')

        <form method="POST" action=" {{ route('admin.orders.update', ['order' => $order->order_code]) }}"
            enctype="multipart/form-data" class="formOrder">

            @csrf

            @method('PUT')

            @include(
                'partials.forms.edit_form_element',
                $data = [
                    'default' => $order->status,
                    'type' => 'selectArray',
                    'field' => 'status',
                    'label' => "Stato dell'ordine",
                    'options' => $status,
                ]
            )

            <button type="submit"> Invia </button>
        </form>
        <div class="d-flex justify-content-center" id="torna_indietro">
            <a href="{{ route('admin.orders.index') }}" class="button_my">Torna indietro</a>
        </div>
    </div>

@endsection
