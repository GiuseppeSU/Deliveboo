@extends('layouts.app')

{{-- @section('page-title', 'New Project') --}}

@section('content')
    <div class="container">

        @include('partials.forms.validation.errors_alert')

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">

            @csrf

            @include(
                'partials.forms.create_form_element',
                $data = ['type' => 'text', 'field' => 'name', 'label' => 'Nome']
            )

            @include(
                'partials.forms.create_form_element',
                $data = ['type' => 'text', 'field' => 'price', 'label' => 'Prezzo']
            )

            @include(
                'partials.forms.create_form_element',
                $data = ['type' => 'file', 'field' => 'image', 'label' => 'Immagine']
            )

            @include(
                'partials.forms.create_form_element',
                $data = ['type' => 'text', 'field' => 'category', 'label' => 'Categoria']
            )

            @include(
                'partials.forms.create_form_element',
                $data = ['type' => 'textarea', 'field' => 'description', 'label' => 'Descrizione']
            )

            <button type="submit" class="btn btn-primary">Invia</button>
        </form>
    </div>
@endsection
