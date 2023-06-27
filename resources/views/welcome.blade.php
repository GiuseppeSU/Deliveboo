@extends('layouts.nav')
@section('content')
    <div class="mt-5">
        <div class="row d-flex justify-content-center container_info ">
            <div class="card_container col-sm-6 col-md-3 mb-3 p-5">
                <img class="w-50" src="img/delivepublic.svg" alt="Registrati">
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


<style lang="scss" scoped>
    .card_container {

        border-radius: 10px;
        margin-right: 10px;
        border: 1px solid linear-gradient(to top, rgba(255, 255, 255, 1), rgba(223, 133, 51, 0.5));

    }


    .container_info {}

    .btn-14 {
        background: rgb(255, 151, 0);
        border: none;
        z-index: 1;
    }

    .btn-14:after {
        position: absolute;
        content: "";
        width: 100%;
        height: 0;
        top: 0;
        left: 0;
        z-index: -1;
        border-radius: 5px;
        background-color: rgb(255, 0, 84);
        background-image: linear-gradient(315deg, rgb(255, 0, 84), rgb(255, 0, 84));
        box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, .5);
        7px 7px 20px 0px rgba(0, 0, 0, .1),
        4px 4px 5px 0px rgba(0, 0, 0, .1);
        transition: all 0.3s ease;
    }

    .btn-14:hover {
        color: #000;
    }

    .btn-14:hover:after {
        top: auto;
        bottom: 0;
        height: 100%;
    }

    .btn-14:active {
        top: 2px;
    }

    .custom-btn {
        width: 200px;
        height: 40px;
        color: #fff;
        border-radius: 5px;
        padding: 10px 25px;
        font-family: 'Lato', sans-serif;
        font-weight: 500;
        background: transparent;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        display: inline-block;
        box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, .5),
            7px 7px 20px 0px rgba(0, 0, 0, .1),
            4px 4px 5px 0px rgba(0, 0, 0, .1);
        outline: none;
    }
</style>
