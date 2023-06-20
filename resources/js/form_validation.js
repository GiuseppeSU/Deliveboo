import { forEach } from "lodash";

export function validateRestaurantRegister() {
    //compilazione dei dati
    let submitBtnId = 'submit-register-restaurant';
    let fieldsId = ['password-confirm', 'password', 'address', 'email', 'vat', 'name'];

    const submitBtn = document.getElementById(submitBtnId);

    if (submitBtn) {
        //controllo file
        const imageFile = document.getElementById('image');
        if (imageFile) {
            const imageAlert = document.querySelector(`.image-input-alert`);
            const imageMessage = imageAlert.querySelector('.alert-message');
            imageFile.onchange = (() => {
                let ext = imageFile.value.match(/\.([^\.]+)$/)[1];
                let acceptedExts = ['jpg', 'gif', 'png', 'svg'];
                if (acceptedExts.includes(ext)) {
                    imageFile.classList.add('is-valid')
                    imageFile.classList.remove('is-invalid');
                    imageAlert.classList.add('d-none')
                    imageAlert.classList.remove('text-danger')
                } else {
                    imageFile.classList.remove('is-valid');
                    imageFile.classList.add('is-invalid');
                    imageAlert.classList.remove('d-none')
                    imageAlert.classList.add('text-danger')
                    imageMessage.innerHTML = 'Sono ammessi solo file immagine';
                }
            });
        }


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

            //controllo checkboxes
            const checkboxes = document.querySelectorAll(`input[name='types[]']:checked`);
            const fieldAlert = document.querySelector(`.types-input-alert`);
            const alertMessage = fieldAlert.querySelector('.alert-message');
            if (checkboxes.length) {
                fieldAlert.classList.add('d-none')
                fieldAlert.classList.remove('text-danger')
            } else {
                fieldAlert.classList.remove('d-none')
                fieldAlert.classList.add('text-danger')
                alertMessage.innerHTML = 'Selezionare almeno un tipo.';
            }

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
                        if (!field.value.match(/@.*\.(?:com|it)\b/gm)) {
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
export function validateProduct() {


    const name = document.getElementById('name');
    const price = document.getElementById('price');
    const submitBtn = document.querySelector('.productBtn');
    if(submitBtn) {
    
        submitBtn.addEventListener('click', event => {
            event.preventDefault()

            const nameAlert = document.querySelector('.name-input-alert');
            const priceAlert = document.querySelector('.price-input-alert');
            const nameMessage = nameAlert.querySelector('.alert-message');
            const priceMessage = priceAlert.querySelector('.alert-message');


            nameMessage.innerHTML = '';
            priceMessage.innerHTML = '';
            
                let validField = true;
            
                if (name.value == '') {
                    nameMessage.innerHTML += 'Il campo nome è richiesto. ';
                    validField = false;
                    nameAlert.classList.remove('d-none')
                    nameAlert.classList.add("text-danger");
                }

                if (price.value == '') {
                    priceMessage.innerHTML += 'Il campo prezzo è richiesto. ';
                    validField = false;
                    priceAlert.classList.remove('d-none')
                    priceAlert.classList.add("text-danger");
                }
                if (validField) {
                    const form = document.querySelector('.formProduct');
                    form.submit();
                }
            
            });
        }
}








