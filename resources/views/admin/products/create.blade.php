@extends('layouts.nav')

{{-- @section('page-title', 'New Project') --}}

@section('content')
    <div id="new_container">
        <div class="container container_general">

            @include('partials.forms.validation.errors_alert')

            <form method="POST" class="formProduct" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">

                @csrf

                {{-- Name --}}
                @include(
                    'partials.forms.create_form_element',
                    $data = ['type' => 'text', 'field' => 'name', 'label' => 'Nome']
                )
                @include('partials.forms.validation.front_error_alert', $data = ['field' => 'name'])

                {{-- Price --}}
                @include(
                    'partials.forms.create_form_element',
                    $data = ['type' => 'number', 'field' => 'price', 'label' => 'Prezzo']
                )
                @include('partials.forms.validation.front_error_alert', $data = ['field' => 'price'])

                {{-- Image file --}}
                @include(
                    'partials.forms.create_form_element',

                    $data = ['type' => 'file', 'field' => 'image', 'label' => 'Immagine', 'accepted' => 'image/*']
                )

                {{-- Category --}}
                @include(
                    'partials.forms.create_form_element',
                    $data = [
                        'type' => 'selectArray',
                        'field' => 'category',
                        'label' => 'Categoria',
                        'options' => $categories,
                    ]
                )

                {{-- Description --}}
                @include(
                    'partials.forms.create_form_element',
                    $data = ['type' => 'textarea', 'field' => 'description', 'label' => 'Descrizione']
                )

                {{-- Visibility --}}

                @include(
                    'partials.forms.create_form_element',
                    $data = ['type' => 'checkbox', 'field' => 'visibility', 'label' => 'Pubblicazione immediata']
                )


                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary productBtn">Invia</button>
                </div>

            </form>
        </div>
        <br>
        <div class="d-flex justify-content-center">
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Torna indietro</a>
        </div>


    </div>
@endsection
