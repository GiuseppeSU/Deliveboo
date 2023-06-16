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

    function addAlerts(inputId) {
        const myInput = document.getElementById(inputId);
        const alert = myInput.closest('div').querySelector(".input-alert");
        const message = myInput.closest('div').querySelector(".input-message");
        console.log(message);

        myInput.onfocus = function () {
            message.style.display = "block";
        }
        myInput.onblur = function () {
            message.style.display = "none";
        }
        myInput.onkeyup = function () {
            let trigger;
            switch (inputId){
                case 'password':
                    trigger = (myInput.value.length >= 8);
                    break
                case 'vat':
                    console.log(myInput.value.length);
                    trigger = (myInput.value.length <= 11 && !myInput.value.match(/[^0-9]/g))
                    break;
                default :
                    console.log('alert-switch: input non riconosciuto');
            }
            // Validate length
            console.log(trigger);
            if (trigger) {
                alert.classList.remove("invalid", "text-danger");
                alert.classList.add("valid");
                message.style.display = "none";
            } else {
                console.log( inputId+' errore');
                alert.classList.remove("valid");
                alert.classList.add("invalid", "text-danger");
                message.style.display = "block";
            }

            // Validate lowercase letters
            // var lowerCaseLetters = /[a-z]/g;
            // if (myInput.value.match(lowerCaseLetters)) {
            //     letter.classList.remove("invalid");
            //     letter.classList.add("valid");
            // } else {
            //     letter.classList.remove("valid");
            //     letter.classList.add("invalid");
            // }

            // Validate capital letters
            // var upperCaseLetters = /[A-Z]/g;
            // if (myInput.value.match(upperCaseLetters)) {
            //     capital.classList.remove("invalid");
            //     capital.classList.add("valid");
            // } else {
            //     capital.classList.remove("valid");
            //     capital.classList.add("invalid");
            // }

            /*Validate numbers
            var numbers = /[0-9]/g;
            if (myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }*/


        }
    }



};



