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
                            @include(
                                'partials.forms.create_form_element',
                                $data = ['type' => 'text', 'field' => 'name', 'label' => 'Nome']
                            )

                            <!-- p.iva -vat-->
                            @include(
                                'partials.forms.create_form_element',
                                $data = ['type' => 'text', 'field' => 'vat', 'label' => 'P.Iva']
                            )
                            <!-- IMG-->

                            @include(
                                'partials.forms.create_form_element',
                                $data = ['type' => 'file', 'field' => 'image', 'label' => 'Immagine']
                            )
                            <!-- email-->
                            @include(
                                'partials.forms.create_form_element',
                                $data = ['type' => 'email', 'field' => 'email', 'label' => 'E-mail']
                            )

                            @include(
                                'partials.forms.create_form_element',
                                $data = ['type' => 'text', 'field' => 'address', 'label' => 'Indirizzo']
                            )

                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="mb-3">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="mb-3">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
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
