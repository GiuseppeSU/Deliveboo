@extends('layouts.nav')

{{-- @section('page-title', 'Edit Project') --}}

@section('content')
    <div id="edit_container">
        <div class="container container_general rounded-4">

            @include('partials.forms.validation.errors_alert')

            <form method="POST" action=" {{ route('admin.products.update', ['product' => $product->slug]) }}"
                enctype="multipart/form-data" class="formProduct">

                @csrf

                @method('PUT')

                @include(
                    'partials.forms.edit_form_element',
                    $data = ['default' => $product->name, 'type' => 'text', 'field' => 'name', 'label' => 'Nome']
                )
                @include('partials.forms.validation.front_error_alert', $data = ['field' => 'name'])

                @include(
                    'partials.forms.edit_form_element',
                    $data = [
                        'default' => $product->price,
                        'type' => 'number',
                        'field' => 'price',
                        'label' => 'Prezzo',
                    ]
                )
                @include('partials.forms.validation.front_error_alert', $data = ['field' => 'price'])



                @include(
                    'partials.forms.edit_form_element',
                    $data = [
                        'default' => $product->image,
                        'type' => 'file',
                        'field' => 'image',
                        'label' => 'Immagine',
                        'accepted' => 'image/*',
                    ]
                )

                @include(
                    'partials.forms.edit_form_element',
                    $data = [
                        'default' => $product->category,
                        'type' => 'selectArray',
                        'field' => 'category',
                        'label' => 'Categoria',
                        'options' => $categories,
                    ]
                )

                @include(
                    'partials.forms.edit_form_element',
                    $data = [
                        'default' => $product->description,
                        'type' => 'textarea',
                        'field' => 'description',
                        'label' => 'Descrizione',
                    ]
                )

                {{-- Checkbox visibilità --}}
                @include(
                    'partials.forms.edit_form_element',
                    $data = [
                        'type' => 'checkbox',
                        'label' => 'Pubblica',
                        'field' => 'visibility',
                        'default' => $product->visibility,
                    ]
                )
                <div class="d-flex justify-content-center">
                    <button type="submit"> Invia </button>
                </div>

            </form>
        </div>
        <br>
        <div class="d-flex justify-content-center" id="torna_indietro">
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary productBtn">Torna indietro</a>
        </div>

        @include(
            'partials.forms.edit_form_element',
            $data = [
                'type' => 'delete-form',
                'field' => 'image',
                'delete-file-object' => $product,
                'delete-file-route' => 'admin.products.deleteImg',
            ]
        )
    </div>
@endsection
