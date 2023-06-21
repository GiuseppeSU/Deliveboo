@extends('layouts.nav')

{{-- @section('page-title', 'Edit Project') --}}

@section('content')
    <div class="container">

        @include('partials.forms.validation.errors_alert')

        <form method="POST" action=" {{ route('admin.products.update', ['product' => $product->slug]) }}"
            enctype="multipart/form-data" class="formProduct">

            @csrf

            @method('PUT')

            @include(
                'partials.forms.edit_form_element',
                $data = ['default' => $product->name, 'type' => 'text', 'field' => 'name', 'label' => 'Nome']
            )
            @include(
                'partials.forms.validation.front_error_alert',
                $data = ['field'=> 'name']
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
                'partials.forms.validation.front_error_alert',
                $data = ['field'=> 'price']
            )
            <!--Checkbox visibilità-->
            <div class="mb-3">
                <p>Visibile</p>
                <ul class="list-group">
                    
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" name="visibility"
                            @checked($product->visibility) id="visibility" 
                            />
                            <label class="form-check-label"
                                for="visibility">Visibilità</label>
                        </li>
                    
                    @include('partials.forms.validation.error_alert', ['field' => $data['field']])
                </ul>
            </div>

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


            <button type="submit" class="btn btn-primary productBtn"> Invia </button>
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
