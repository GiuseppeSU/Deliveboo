import './bootstrap';
import '~resources/scss/app.scss';
import './mychart.js';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])
import { validateRestaurantRegister } from './form_validation';
import { validateProduct } from './form_validation';


// *** SWEET DELETE ***
const deleteButtons = document.querySelectorAll('.form_delete_product button[type="submit"]');
deleteButtons.forEach(button => {
    button.addEventListener('click', event => {
        event.preventDefault();

        const modal = document.getElementById('confirmModal');

        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();

        const confirmDeleteBtn = modal.querySelector('.btn.btn-danger')

        confirmDeleteBtn.addEventListener('click', () => {
            button.parentElement.submit();
        });
    })
});

// *** EDIT IMAGE DELETE function ***
function addFormElementDelete(fieldName){
    const deleteBtn = document.querySelector('.'+fieldName+'.btn');
    if(deleteBtn){
        deleteBtn.addEventListener('click', () => {
            const deleteForm = document.querySelector('.'+fieldName+' form');
            deleteForm.submit();
        })
    }
}


// *** EDIT IMAGE DELETE ***
addFormElementDelete('image');

// *** RESTAURANT REGISTER FORM VALIDATION ***
validateRestaurantRegister();

// *** PRODUCT FORMS VALIDATION ***
validateProduct();