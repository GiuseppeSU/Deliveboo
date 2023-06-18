@extends('layouts.nav')

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
                            <div class="vat-input-alert d-none d-none">
                                <span class="vat-input-message invalid">
                                    <small class="input-empty d-none">Il campo è richiesto.</small>
                                    <small class="input-length">La p. Iva deve essere di 11 cifre.</small>
                                    <small class="input-char"> Sono ammessi solo numeri.</small>
                                </span>
                            </div>
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

                            @include(
                                'partials.forms.create_form_element',
                                $data = ['type' => 'checkboxes', 'field' => 'types',  'options' => $types, 'label' => 'Tipo di Cucina']
                            )

                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="mb-3">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                        title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                        required>

                                        <div class="password-input-alert d-none">
                                            <span class="password-input-message invalid">
                                                <small class="input-empty d-none">Il campo è richiesto</small>
                                                <small class="input-length">La password deve essere lunga almeno 8 caratteri.</small>
                                            </span>
                                        </div>

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
                                        name="password_confirmation">
                                    
                                        <div class="password-confirm-input-alert d-none">
                                            <span class="password-confirm-input-message invalid">
                                                <small class="input-empty d-none">Il campo è richiesto</small>
                                                <small class="input-value">Il valore non coincide con quello del campo password</small>
                                            </span>
                                        </div>
                                </div>
                            </div>

                            <div class="mb-4 d-flex mb-0 justify-content-center">
                                
                                <button type="submit" class="btn btn-primary" id="submit-register-restaurant">
                                    {{ __('Registrati') }}
                                </button>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
