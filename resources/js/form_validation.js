import { forEach } from "lodash";

export function validateRestaurantRegister() {
    //compilazione dei dati
    let submitBtnId = 'submit-register-restaurant';
    let fieldsId = ['password-confirm', 'password', 'address', 'email', 'vat', 'name'];

    const submitBtn = document.getElementById(submitBtnId);

    if (submitBtn) {
        //TYPING CHECK
        fieldsId.forEach(id => {
            const field = document.getElementById(id);
            const fieldAlert = document.querySelector(`.${id}-input-alert`);
            const alertMessage = fieldAlert.querySelector('.alert-message');

            field.onfocus = (() => {
                fieldAlert.classList.remove('d-none', 'text-danger');
                switch (id) {
                    case 'vat':
                        alertMessage.innerHTML = 'Inserisci le 11 cifre, solo numeri.';
                        break;
                    case 'password':
                        alertMessage.innerHTML = 'Inserisci una password di almeno 8 caratteri.';
                        break;
                    case 'password-confirm':
                        alertMessage.innerHTML = 'Deve coincidere con la password inserita prima.';
                        break;
                    default:
                        break;
                }
            })
            field.onblur = (() => {
                fieldAlert.classList.add('d-none');
            })
            field.onkeyup = (() => {
                isFieldValid(id);
            })
        });

        //SUBMIT CHECK

        submitBtn.addEventListener('click', event => {
            event.preventDefault();
            let isFormValid = true;
            //controllo i campi
            fieldsId.forEach(id => {
                if (!isFieldValid(id)) {
                    isFormValid = false;
                };
            })
            // esito controllo form completo
            if (isFormValid) {
                const form = document.querySelector('form');
                form.submit();
            }
        })

        // FIELD CHECK
        function isFieldValid(id) {
            const field = document.getElementById(id);
            const fieldAlert = document.querySelector(`.${id}-input-alert`);
            const alertMessage = fieldAlert.querySelector('.alert-message');

            alertMessage.innerHTML = '';
            let validField = true;

            //controllo campo vuoto
            if (field.value.trim() == '') {
                alertMessage.innerHTML += 'Il campo è richiesto. ';
                validField = false;
            }

            // controlli specifici
            if (validField) {
                switch (id) {
                    case 'vat':
                        if (field.value.length != 11) {
                            alertMessage.innerHTML += 'Deve contenere 11 cifre. ';
                            validField = false;
                        }
                        if (field.value.match(/[^0-9]/g)) {
                            alertMessage.innerHTML += 'Sono ammessi solo numeri. ';
                            validField = false;
                        }
                        break;
                    case 'email':
                        if (!field.value.match(/@{1}[a-z]+.com|it/gm)) {
                            alertMessage.innerHTML += 'Inserisci una mail valida. ';
                            validField = false;
                        }
                        break;
                    case 'password':
                        if (field.value.length < 8) {
                            alertMessage.innerHTML += 'Deve contenere almeno 8 caratteri. ';
                            validField = false;
                        }
                        break;
                    case 'password-confirm':
                        let pwd = document.getElementById('password');
                        if (field.value != pwd.value) {
                            alertMessage.innerHTML += 'Il valore non coincide. ';
                            validField = false;
                        }
                        break;
                    default:
                        break;
                }
            }

            // esito controllo campo singolo
            if (validField) {
                field.classList.remove('is-invalid');
                field.classList.add('is-valid');
                fieldAlert.classList.remove("text-danger");
                fieldAlert.classList.add("d-none");
            } else {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
                fieldAlert.classList.add("text-danger");
                fieldAlert.classList.remove("d-none");
            }

            return validField;
        }
    }

};