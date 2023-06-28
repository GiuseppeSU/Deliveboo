import Chart from 'chart.js/auto';
import './bootstrap';
import '~resources/scss/app.scss';
import axios from 'axios';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])


//let canvas = document.getElementById('myChart');
//let orders = JSON.parse(canvas.dataset.id);

let orders = axios.get('http://127.0.0.1:8000/apiadmin/stats')






const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
];

const data = {
    labels: labels,
    datasets: [{
        label: 'My First dataset',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [1, 5, 23, 42, 6, 9, 74]
    }]
};

const config = {
    type: 'line',
    data: data,
    options: {}
};

new Chart(
    document.getElementById('myChart'),
    config
);