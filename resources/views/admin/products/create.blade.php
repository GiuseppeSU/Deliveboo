@extends('layouts.nav')

{{-- @section('page-title', 'New Project') --}}

@section('content')
    <div class="container">

        @include('partials.forms.validation.errors_alert')

        <form method="POST" class="formProduct" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">

            @csrf

            {{-- Name --}}
            @include(
                'partials.forms.create_form_element',
                $data = ['type' => 'text', 'field' => 'name', 'label' => 'Nome']
                
            )
            @include(
                'partials.forms.validation.front_error_alert',
                $data = ['field'=> 'name']
            )

            {{-- Price --}}
            @include(
                'partials.forms.create_form_element',
                $data = ['type' => 'number', 'field' => 'price', 'label' => 'Prezzo' ]
            )
            @include(
                'partials.forms.validation.front_error_alert',
                $data = ['field'=> 'price']
            )

            {{-- Image file --}}
            @include(
                'partials.forms.create_form_element',
                
                $data = ['type' => 'file', 'field' => 'image', 'label' => 'Immagine', 'accepted' => 'image/*']
            )

            {{-- Category --}}
            @include(
                'partials.forms.create_form_element',
                $data = ['type' => 'text', 'field' => 'category', 'label' => 'Categoria']
            )

            {{-- Description --}}
            @include(
                'partials.forms.create_form_element',
                $data = ['type' => 'textarea', 'field' => 'description', 'label' => 'Descrizione']
            )

             {{-- Visibility --}}

             @include('partials.forms.create_form_element',
             $data = ['type' => 'checkbox', 'field' => 'visibility', 'label' => 'Pubblicazione immediata'])
 

            <button type="submit" class="btn btn-primary productBtn">Invia</button>
        </form>
    </div>
 

        

@endsection
