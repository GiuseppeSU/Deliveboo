import Chart from 'chart.js/auto';
import './bootstrap';
import '~resources/scss/app.scss';
import { forEach, sum } from 'lodash';
import.meta.glob([
    '../img/**'
])

const year = document.getElementById('year');
const canvas = document.getElementById('myCountChart');


year.addEventListener('change', (event) => {
    let orders = null;

    if(event.target.value = '2022') {
        return orders = JSON.parse(JSON.parse(canvas.dataset.orders2022));
    
    } else if (event.target.value = '2023') {
        return orders = JSON.parse(JSON.parse(canvas.dataset.orders2023));
    }
    console.log(orders)
    
});

let monthly_orders = [];
let monthly_total = [];

for (let i = 1; i < 13; i++) {

    let selectedMonthOrders = orders.filter(order => {
        let splitdDate = order.created_at.split('-');
        return splitdDate[1] == i;
        
    });

    let ordersTotal = 0;
    selectedMonthOrders.forEach(order => {
        ordersTotal += parseInt(order.total);
    });

    monthly_orders.push(selectedMonthOrders.length);
    monthly_total.push(ordersTotal);
    
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

const dataCount = {
    labels: labels,
    datasets: [
        {
            label: 'Numero di ordini nel 2022',
            backgroundColor: 'white',
            borderColor: 'black',
            data: monthly_orders
        },
    ]
};

const configCount = {
    type: 'bar',
    data: dataCount,
    options: {}
};

new Chart(
    document.getElementById('myCountChart'),
    configCount
);

const dataTotal = {
    labels: labels,
    datasets: [
        {
            label: 'Totale guadagni nel 2022',
            backgroundColor: 'white',
            borderColor: 'black',
            data: monthly_total
        }
    ]
};

const configTotal = {
    type: 'line',
    data: dataTotal,
    options: {}
};

new Chart(
    document.getElementById('myTotalChart'),
    configTotal
);
