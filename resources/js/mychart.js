import Chart from 'chart.js/auto';
import './bootstrap';
import '~resources/scss/app.scss';
import { forEach, sum } from 'lodash';
import.meta.glob([
    '../img/**'
])

const year = document.getElementById('year');
const canvas = document.getElementById('myCountChart');
let orders = null;

year.addEventListener('change', function() {

    if(year.value == '2022') {
        
        removeData(configCount)
        removeData(configTotal)
        orders = JSON.parse(JSON.parse(canvas.dataset.orders2022));
        addData(configCount, labels, dataCount)
        addData(configTotal, labels, dataTotal)
        
    } else if (year.value == '2023') {

        removeData(configCount)
        removeData(configTotal)
        orders = JSON.parse(JSON.parse(canvas.dataset.orders2023));
        addData(configCount, labels, dataCount)
        addData(configTotal, labels, dataTotal)
    }
    console.log(orders)
    
});

    let monthly_orders = [];
    let monthly_total = [];

for (let i = 1; i < 13; i++) {

    let selectedMonthOrders = element.filter(order => {
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
    'Dicembre'
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

function addData(chart, label, data) {
    chart.data.labels.push(label);
    chart.data.datasets.forEach((dataset) => {
        dataset.data.push(data);
    });
    chart.update();
}

function removeData(chart) {
    chart.data.labels.pop();
    chart.data.datasets.forEach((dataset) => {
        dataset.data.pop();
    });
    chart.update();
}




