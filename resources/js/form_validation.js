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
    addAlerts('password-confirm');

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

            // il campo non può essere vuoto
            let emptyInput = message.querySelector('.input-empty');
            if(myInput.value == ''){
                emptyInput.classList.remove('d-none');
            }else{
                emptyInput.classList.add('d-none');
            }

            switch (inputId){
                case 'password':
                    isInputInvalid = false;
                    //la password deve avere almeno 8 cifre
                    let pwdLength =  message.querySelector('.input-length');
                    if(myInput.value.length < 8){
                        isInputInvalid = true;
                        pwdLength.classList.remove('d-none');
                    }else{
                        pwdLength.classList.add('d-none')
                    }
                    break
                case 'password-confirm':
                    console.log('sono qui')
                    isInputInvalid = false;
                    //il valore della conferma password deve coincidere con quello della password
                    let pwdValue =  message.querySelector('.input-value');
                    if(myInput.value != document.getElementById('password').value){
                        console.log('conferma password non valida')
                        isInputInvalid = true;
                        pwdValue.classList.remove('d-none');
                    }else{
                        console.log('conferma password valida');
                        pwdValue.classList.add('d-none');
                    }
                    break
                case 'vat':
                    isInputInvalid = false;
                    //la p.iva deve avere 11 cifre
                    let vatLength =  message.querySelector('.input-length');
                    if(myInput.value.length != 11){
                        isInputInvalid = true;
                        vatLength.classList.remove('d-none');
                    }else{
                        vatLength.classList.add('d-none')
                    }
                    //la p.iva deve contenere solo numeri
                    let vatChar =  message.querySelector('.input-char');
                    if(myInput.value.match(/[^0-9]/g)){
                        isInputInvalid = true;
                        vatChar.classList.remove('d-none');
                    }else{
                        vatChar.classList.add('d-none')
                    }
                    break;
                default :
                    console.log('alert-switch: input non riconosciuto');
            }
            
            if (isInputInvalid) {
                // console.log( inputId+' errore');
                myInput.classList.remove('is-valid');
                myInput.classList.add('is-invalid');
                alert.classList.add("is-invalid");
            } else {
                myInput.classList.remove('is-invalid');
                myInput.classList.add('is-valid');
                alert.classList.remove("is-invalid");
            }
        }
    }
};