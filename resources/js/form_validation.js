import { forEach } from "lodash";

export function validateForms() {

    // *** FORM CREAZIONE RISTORANTE ***
    validateForm(
        'submit-register-restaurant',
        [
            {
                id: 'name',
                required: true,
                type: 'input',
                message: 'Inserisci un nome per il tuo ristorante.',

            },
            {
                id: 'vat',
                required: true,
                type: 'input',
                message: 'Inserisci le 11 cifre, solo numeri.',

            },
            {
                id: 'email',
                required: true,
                type: 'input',
                message: 'Inserisci una mail valida.',

            },
            {
                id: 'address',
                required: true,
                type: 'input',
                message: 'Inserisci un indirizzo.',

            },
            {
                id: 'password',
                required: true,
                type: 'input',
                message: 'Inserisci una password di almeno 8 caratteri.',

            },
            {
                id: 'password-confirm',
                required: true,
                type: 'input',
                message: 'Deve coincidere con la password inserita prima.',

            },
            {
                id: 'types',
                required: true,
                type: 'checkboxes',
                message: 'Seleziona almeno un campo.',

            },
            {
                id: 'image',
                required: false,
                type: 'file',
                message: 'Seleziona un file immagine. I formati validi sono: jpg,gif,png,svg.'

            },
        ]
    )

};

// Funzione che effettua i controlli sui campi di un form.
// Richiede l'id del pulsante di submit e un array di oggetti

// ESEMPIO DI FIELDS
// let fields = [
//     {
//         id: 'idString',
//         required: true/false,
//         type: 'input/file/checkboxes',
//         message: '',
//     }
// ];
function validateForm(submitBtnId, fields) {

    const submitBtn = document.getElementById(submitBtnId);
    if (submitBtn) {

        fields.forEach(field => {

            // *** DOM LINKS ***
            let formElement;
            if (field.type == 'checkboxes') {
                formElement = document.querySelectorAll(`input[name='${field.id}[]']:checked`);
            } else {
                formElement = document.getElementById(field.id);
            }
            const inputAlert = document.querySelector(`.${field.id}-input-alert`);
            const alertMessage = inputAlert.querySelector('.alert-message');

            // *** FOCUS ***
            formElement.onfocus = (() => {
                inputAlert.classList.remove('d-none', 'text-danger');
                alertMessage.innerHTML = field.message;
            })
            formElement.onblur = (() => {
                inputAlert.classList.add('d-none');
            })

            // *** FILES ***
            if (field.type == 'file') {
                formElement.onchange = (() => {
                    isFieldValid(field);
                });
            }

            // *** CONTROLLO MENTRE SI DIGITA ***
            formElement.onkeyup = (() => {
                isFieldValid(field);
            })
        })

        //SUBMIT CHECK

        submitBtn.addEventListener('click', event => {

            event.preventDefault();

            let isFormValid = true;

            //CONTROLLO DI TUTTI I CAMPI DEL FORM
            fields.forEach(field => {
                if (!isFieldValid(field)) {
                    isFormValid = false;
                };
            })

            // ESITO
            if (isFormValid) {
                const form = document.querySelector('form');
                form.submit();
            }
        })

        // FIELD CHECK - funzione di appoggio
        function isFieldValid(field) {

            let formElement;
            if (field.type == 'checkboxes') {
                formElement = document.querySelectorAll(`input[name='${field.id}[]']:checked`);
            } else {
                formElement = document.getElementById(field.id);
            }
            const inputAlert = document.querySelector(`.${field.id}-input-alert`);
            const alertMessage = inputAlert.querySelector('.alert-message');

            alertMessage.innerHTML = '';
            let validField = true;

            //CAMPO RICHIESTO
            if (field.required) {
                if (field.type == 'checkboxes') {
                    if (!formElement.length) {
                        alertMessage.innerHTML = 'Selezionare almeno un elemento.';
                        validField = false;
                    };
                }
                else if (formElement.value.trim() == '') {
                    alertMessage.innerHTML += 'Questo campo è richiesto.';
                    validField = false;
                }
            }

            // CONTROLLI SELETTIVI
            if (validField) {
                switch (field.id) {
                    case 'vat':
                        if (formElement.value.length != 11) {
                            alertMessage.innerHTML += 'Deve contenere 11 cifre. ';
                            validField = false;
                        }
                        if (formElement.value.match(/[^0-9]/g)) {
                            alertMessage.innerHTML += 'Sono ammessi solo numeri. ';
                            validField = false;
                        }
                        break;
                    case 'email':
                        if (!formElement.value.match(/@.*\.(?:com|it)\b/gm)) {
                            alertMessage.innerHTML += 'Inserisci una mail valida. ';
                            validField = false;
                        }
                        break;
                    case 'password':
                        if (formElement.value.length < 8) {
                            alertMessage.innerHTML += 'Deve contenere almeno 8 caratteri. ';
                            validField = false;
                        }
                        break;
                    case 'password-confirm':
                        let pwd = document.getElementById('password');
                        if (formElement.value != pwd.value) {
                            alertMessage.innerHTML += 'Il valore non coincide. ';
                            validField = false;
                        }
                        break;
                    case 'image':
                        if (formElement.value) {
                            let fileExt = formElement.value.match(/\.([^\.]+)$/)[1];
                            let acceptedExts = ['jpg', 'gif', 'png', 'svg'];
                            if (!acceptedExts.includes(fileExt)) {
                                alertMessage.innerHTML += 'Sono ammessi solo file immagine';
                                validField = false;
                            }
                        }

                        break;
                    default:
                        break;
                }
            }

            // ESITO CONTROLLO FIELD
            if (validField) {
                if (formElement.classlist) {
                    formElement.classList.remove('is-invalid');
                    formElement.classList.add('is-valid');
                }
                inputAlert.classList.remove("text-danger");
                inputAlert.classList.add("d-none");
            } else {
                if (formElement.classlist) {
                    formElement.classList.remove('is-valid');
                    formElement.classList.add('is-invalid');
                }
                inputAlert.classList.add("text-danger");
                inputAlert.classList.remove("d-none");
            }

            return validField;
        }
    }

};