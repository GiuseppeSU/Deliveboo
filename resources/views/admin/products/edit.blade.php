@extends('layouts.nav')

{{-- @section('page-title', 'Edit Project') --}}

@section('content')
    <div class="container">

        @include('partials.forms.validation.errors_alert')

        <form method="POST" action=" {{ route('admin.products.update', ['product' => $product->slug]) }}"
            enctype="multipart/form-data">

            @csrf

            @method('PUT')

            @include(
                'partials.forms.edit_form_element',
                $data = ['default' => $product->name, 'type' => 'text', 'field' => 'name', 'label' => 'Nome']
            )

            @include(
                'partials.forms.edit_form_element',
                $data = [
                    'default' => $product->price,
                    'type' => 'number',
                    'field' => 'price',
                    'label' => 'Prezzo',
                ]
            )

            @include(
                'partials.forms.edit_form_element',
                $data = [
                    'default' => $product->image,
                    'type' => 'file',
                    'field' => 'image',
                    'label' => 'Immagine',
                ]
            )

            @include(
                'partials.forms.edit_form_element',
                $data = [
                    'default' => $product->category,
                    'type' => 'text',
                    'field' => 'category',
                    'label' => 'Categoria',
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


            <button type="submit" class="btn btn-primary"> Invia </button>
        </form>
    </div>

    {{-- @include(
        'partials.forms.edit_form_element',
        $data = [
            'type' => 'delete-form',
            'field' => 'image',
            'delete-file-object' => $product,
            'delete-file-route' => 'admin.product.deleteImg',
        ]
    ) --}}
@endsection
