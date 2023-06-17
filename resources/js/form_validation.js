export function validateRestaurantRegister() {
    //verificare id del pulsante di submit
    const submitBtn = document.getElementById('submit-register-restaurant');

    submitBtn.addEventListener('click', event => {
        event.preventDefault();

        // controllo name (restaurant)
        // let name = document.getElementById('name').value;
        // console.log(name);

        // controllo password
        let password = document.getElementById('password');

        if (password.value.length < 8) {
            console.log('password non valida');
            return
        }


        // controllo vat
        let vat = document.getElementById('vat').value;
        if (vat.length != 11 || vat.match(/[^0-9]/g)) {
            console.log('vat errore');
            return
        }

        // controllo address
        // let address = document.getElementById('address').value;
        const form = document.querySelector('form');
        form.submit();

    })


    addAlerts('password');
    addAlerts('vat');

    // funzione che aggiunge dei controlli sugli input richiedendo l'id dell'input da controllare.
    function addAlerts(inputId) {
        const myInput = document.getElementById(inputId);
        const alert = document.querySelector(`.${inputId}-input-alert`);
        const message = document.querySelector(`.${inputId}-input-message`);

        myInput.onfocus = function () {
            alert.style.display = "block";
        }
        myInput.onblur = function () {
            alert.style.display = "none";
        }
        myInput.onkeyup = function () {
            let isInputInvalid;
            let messages = {};

            switch (inputId){
                case 'password':
                    isInputInvalid = (myInput.value.length < 8);
                    break
                case 'vat':
                    isInputInvalid = false;
                    //la p.iva deve avere 11 cifre
                    if(myInput.value.length != 11){
                        isInputInvalid = true;

                    }
                    //la p.iva deve contenere solo numeri
                    if(myInput.value.match(/[^0-9]/g)){
                        isInputInvalid = true;
                    }
                    break;
                default :
                    console.log('alert-switch: input non riconosciuto');
            }
            
            //
            if (isInputInvalid) {
                console.log( inputId+' errore');
                myInput.classList.remove('is-valid');
                myInput.classList.add('is-invalid');
                alert.classList.add("is-invalid", "text-danger");
            } else {
                myInput.classList.remove('is-invalid');
                myInput.classList.add('is-valid');
                alert.classList.remove("is-invalid", "text-danger");
            }
        }
    }
};