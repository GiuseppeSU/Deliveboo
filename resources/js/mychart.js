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

let monthly_orders = [];
let monthly_total = [];

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

const countChart = new Chart(
    document.getElementById('myCountChart'),
    generateCount()
);

const totalChart = new Chart(
    document.getElementById('myTotalChart'),
    generateTotal()
);

year.addEventListener('change', function() {

    if(year.value == '2022') {

        if(countChart) {
            removeData(countChart)
            removeData(totalChart)
        }
        getFilter();
        orders = JSON.parse(JSON.parse(canvas.dataset.orders2022));
        addData(countChart, labels, dataCount)
        addData(totalChart, labels, dataTotal)
        
    } else if (year.value == '2023') {

        if(countChart) {
            removeData(countChart)
            removeData(totalChart)
        }
        getFilter();
        orders = JSON.parse(JSON.parse(canvas.dataset.orders2023));
        addData(countChart, labels, dataCount)
        addData(totalChart, labels, dataTotal)
    }
    console.log(orders)
    
});

function getFilter() {
    
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

}
//funzioni di generazione Chart

function generateCount() {

    const configCount = null;

    const dataCount = {
        labels: labels,
        datasets: [
            {
                label: 'Numero di ordini',
                backgroundColor: 'white',
                borderColor: 'black',
                data: monthly_orders
            },
        ]
    };
    
    configCount = {
        type: 'bar',
        data: dataCount,
        options: {}
    };

    return configCount;
}

function generateTotal() {

    const configTotal = null;

    const dataTotal = {
        labels: labels,
        datasets: [
            {
                label: 'Totale guadagni',
                backgroundColor: 'white',
                borderColor: 'black',
                data: monthly_total
            }
        ]
    };
    
    configTotal = {
        type: 'line',
        data: dataTotal,
        options: {}
    };

    return configTotal;
}

//Funzioni aggiornamento dati dei chart
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




