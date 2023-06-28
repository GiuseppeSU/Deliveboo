import Chart from 'chart.js/auto';
import './bootstrap';
import '~resources/scss/app.scss';
import { forEach, sum } from 'lodash';
import.meta.glob([
    '../img/**'
])


let canvas = document.getElementById('myChart');
let orders = JSON.parse(JSON.parse(canvas.dataset.orders));
let monthly_orders = [];
for(let i=1;i<13;i++){
    let selectedMonthOrders = orders.filter(order => {
        let splitdDate = order.created_at.split('-');
        return splitdDate[1] == i;
    })
    let ordersTotal = selectedMonthOrders.map(order => order.total)
    monthly_orders.push([selectedMonthOrders.length,sum(ordersTotal)]);
    console.log
}

const labels = [
    'Gennaio',
    'Febbraio',
    'Marzo',
    'Aprile',
    'Maggio',
    'Giugno',
    'Luglio',
    'Agosto',
    'Settembre',
    'Ottobre',
    'Novembre',
    'Dicembre',
];

const data = {
    labels: labels,
    datasets: [{
        label: 'Ordini del 2022',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: monthly_orders,
    }]
};

const config = {
    type: 'bar',
    data: data,
    options: {}
};

new Chart(
    document.getElementById('myChart'),
    config
);