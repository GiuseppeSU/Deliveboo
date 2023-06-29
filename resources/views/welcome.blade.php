@extends('layouts.nav')
@section('content')
    <div id="welcome_container" class="mt-5">
        <div class="row d-flex justify-content-center container_info ">
            <div class="card_container col-sm-6 col-md-3 mb-3 p-5">
                <img class="w-50" src="img/boo.svg" alt="Registrati">
                <h3>DeliveBoo</h3>
                <p>è il punto di incontro tra te e i tuoi potenziali clienti, affezionati alla nostra piattaforma.</p>
            </div>


            <div class="card_container col-sm-6 col-md-3 mb-3  p-5">
                <img class="w-50 align-items-center" src="img/register.svg" alt="Aggiungi i tuoi piatti">
                <h3>Adesione a zero rischi</h3>
                <p>Non ci sono costi fissi adesione. Le nostre entrate dipendono dalle commissioni, e quindi dal successo
                    della tua attività.
                </p>
            </div>


            <div class="card_container col-sm-6 col-md-3 mb-3  p-5">
                <img class="w-50" src="img/delivery.svg" alt="Registrati">
                <h3>Consegne su misura </h3>
                <p>I nostri servizi, le opportunità delle opzioni di consegna e il nostro supporto smart possono essere
                    utili ad attività come la tua.</p>
            </div>
        </div>
    </div>

    <div class="general_container p-3">
        <div class="row d-flex justify-content-center  ">
            <div class="card_container col-sm-6 col-md-3 mb-3  p-5">
                <img class="w-50" src="img/iscrition.svg" alt="Registrati">
                <h3>Registrati</h3>
                <p>Inserisci i tuoi dati nel form. Ti faremo una serie di domande sulla tua attività</p>
            </div>


            <div class="card_container col-sm-6 col-md-3 mb-3  p-5">
                <img class="w-50 align-items-center" src="img/add.svg" alt="Aggiungi i tuoi piatti">
                <h3>Inserisci i tuoi piatti</h3>
                <p>Inserisci la lista dei tuoi piatti</p>
            </div>


            <div class="card_container col-sm-6 col-md-3 mb-3  p-5">
                <img class="w-50" src="img/sell.svg" alt="Registrati">
                <h3>Inizia a vendere </h3>
                <p>Dai uno slancio alla tua attività</p>
            </div>
        </div>
        <div class=" d-flex justify-content-center">
            <button class="custom-btn btn-14"><a class="nav-link"
                    href="{{ route('register') }}">{{ __('Register') }}</a></button>
        </div>
    </div>
@endsection
