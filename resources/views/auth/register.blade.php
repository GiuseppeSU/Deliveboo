@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">

                            @csrf

                            @include('partials.forms.validation.errors_alert')

                            {{-- Campo Nome --}}
                            @include(
                                'partials.forms.create_form_element',
                                $data = ['type' => 'text', 'field' => 'name', 'label' => 'Nome']
                            )
                            @include(
                                'partials.forms.validation.front_error_alert',
                                $data = ['field' => 'name']
                            )

                            {{-- Campo P. Iva --}}
                            @include(
                                'partials.forms.create_form_element',
                                $data = ['type' => 'text', 'field' => 'vat', 'label' => 'P.Iva']
                            )
                            @include(
                                'partials.forms.validation.front_error_alert',
                                $data = ['field' => 'vat']
                            )

                            {{-- Campo Immagine --}}

                            @include(
                                'partials.forms.create_form_element',
                                $data = ['type' => 'file', 'field' => 'image', 'label' => 'Immagine']
                            )

                            {{-- Campo Email --}}
                            @include(
                                'partials.forms.create_form_element',
                                $data = ['type' => 'email', 'field' => 'email', 'label' => 'E-mail']
                            )
                            @include(
                                'partials.forms.validation.front_error_alert',
                                $data = ['field' => 'email']
                            )

                            {{-- Campo Indirizzo --}}
                            @include(
                                'partials.forms.create_form_element',
                                $data = ['type' => 'text', 'field' => 'address', 'label' => 'Indirizzo']
                            )
                            @include(
                                'partials.forms.validation.front_error_alert',
                                $data = ['field' => 'address']
                            )

                            {{-- Campo Password --}}
                            <div class="mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            @include(
                                'partials.forms.validation.front_error_alert',
                                $data = ['field' => 'password']
                            )

                            {{-- Campo Conferma Password --}}
                            <div class="mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation">

                            </div>
                            @include(
                                'partials.forms.validation.front_error_alert',
                                $data = ['field' => 'password-confirm']
                            )

                            {{-- Pulsante Submit --}}
                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="submit-register-restaurant">
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
