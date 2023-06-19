@extends('layouts.nav')

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
                'partials.forms.validation.front_error_alert',
                $data = ['field'=> 'name']
            )

            

            @include(
                'partials.forms.create_form_element',
                $data = ['type' => 'number', 'field' => 'price', 'label' => 'Prezzo' ]
            )
              @include(
                'partials.forms.validation.front_error_alert',
                $data = ['field'=> 'price']
            )

            @include(
                'partials.forms.create_form_element',
                
                $data = ['type' => 'file', 'field' => 'image', 'label' => 'Immagine', 'accepted' => 'image/*']
            )

            @include(
                'partials.forms.create_form_element',
                $data = ['type' => 'text', 'field' => 'category', 'label' => 'Categoria']
            )

            @include(
                'partials.forms.create_form_element',
                $data = ['type' => 'textarea', 'field' => 'description', 'label' => 'Descrizione']
            )

            <button type="submit" class="btn btn-primary" id="productBtn">Invia</button>
        </form>
    </div>
 

        

@endsection
