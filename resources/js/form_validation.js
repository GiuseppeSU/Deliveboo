export function validateRestaurantRegister() {
    //verificare id del pulsante di submit
    const submitBtn = document.getElementById('submit-register-restaurant');

    submitBtn.addEventListener('click', event => {
        event.preventDefault();

        // controllo name (restaurant)
        // let name = document.getElementById('name').value;
        // console.log(name);

        // controllo password
        let password = document.getElementById('password').value;
        if (password.length < 8 || !password.match(/[$&?@#-*%!]/g) || password.match(/[+,:;=|'<>.^()]/g)) {
            console.log('password errore');
        }

        // controllo vat
        let vat = document.getElementById('vat').value;
        if (vat.length != 11 || vat.match(/[^0-9]/g)) {
            console.log('vat errore');
        }

        // controllo address
        // let address = document.getElementById('address').value;
        const form = document.querySelector('form');
        form.submit();

    })


    var myInput = document.getElementById("password");
    var length = document.getElementById("length");
    
    myInput.onfocus = function () {
        document.getElementById("message").style.display = "block";
    }
    myInput.onblur = function () {
        document.getElementById("message").style.display = "none";
    }
    myInput.onkeyup = function () {
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

        // Validate length
        if (myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
    }


};



