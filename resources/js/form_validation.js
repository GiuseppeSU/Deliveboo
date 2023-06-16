export function validateRestaurantRegister(){
    //verificare id del pulsante di submit
    const submitBtn = document.getElementById('submit-register-restaurant');

    submitBtn.addEventListener('click', event => {
        event.preventDefault();

        // controllo name (restaurant)
        // let name = document.getElementById('name').value;
        // console.log(name);
    
        // controllo password
        let password = document.getElementById('password').value;
        if(password.length < 8 || !password.match(/[$&?@#-*%!]/g) || password.match(/[+,:;=|'<>.^()]/g)){
            console.log('password errore');
        }

        // controllo vat
        let vat = document.getElementById('vat').value;
        if(vat.length != 11 || vat.match(/[^0-9]/g)){
            console.log('vat errore');
        }

        // controllo address
        // let address = document.getElementById('address').value;

    })
};