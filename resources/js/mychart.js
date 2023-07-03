import Chart from 'chart.js/auto';
import './bootstrap';
import '~resources/scss/app.scss';
import { forEach, sum } from 'lodash';
import.meta.glob([
    '../img/**'
])

const year = document.getElementById('year');
const canvas = document.getElementById('myCountChart');
const ordersTot = document.getElementById('totalOrders');
const sellTot = document.getElementById('totalSell');

let orders = [];

let monthly_orders = [];
let monthly_total = [];

let sumOrders = 0;
let sumTotal = 0;

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

getFilter(orders);
let configCount = {};
let dataCount = {};
sumOrders = getSum(monthly_orders);
sumTotal = getSum(monthly_total);

ordersTot.innerHtml += sumOrders;
sellTot.innerHtml += sumTotal;
generateCount()
let configTotal = {};
let dataTotal = {};

sumOrders = getSum(monthly_orders);
sumTotal = getSum(monthly_total);

ordersTot.innerHtml += sumOrders;
sellTot.innerHtml += sumTotal;
generateTotal()

//creazione prime statistiche
const countChart = new Chart(
    document.getElementById('myCountChart'),
    configCount,
    dataCount,
);

const totalChart = new Chart(
    document.getElementById('myTotalChart'),
    configTotal,
    dataTotal
);
//ascoltatore di eventi per la select
year.addEventListener('change', function() {

    if(year.value == '2022') {
        orders = JSON.parse(JSON.parse(canvas.dataset.orders2022));
    } else if (year.value == '2023') {
        orders = JSON.parse(JSON.parse(canvas.dataset.orders2023));
    } else if (year.value == '0') {
        orders = [];
    }
    console.log(orders)

    getFilter(orders);
    countChart.data.datasets[0].data = monthly_orders;
    totalChart.data.datasets[0].data = monthly_total;


    sumOrders = getSum(monthly_orders);
    sumTotal = getSum(monthly_total);

    ordersTot.innerHtml += sumOrders;
    sellTot.innerHtml += sumTotal;

    countChart.update();
    totalChart.update();
    
});
//funzione di somma dei totali

function getSum(statsElement) {

    let total = 0 
    for(let i = 0; i < statsElement.length; i++) {
        total += statsElement[i]
    }
    console.log(total)
    return total;
}

//funzione di filtraggio dei totali 
function getFilter(element) {
    monthly_orders = [];
    monthly_total = [];
    
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

}
//funzioni di generazione Chart

function generateCount() {

    dataCount = {
        labels: labels,
        datasets: [
            {
                label:'Numero di Ordini',
                backgroundColor: 'blue',
                borderColor: 'black',
                data: monthly_orders
            },
        ]
    }
    
    configCount = {
        type: 'bar',
        data: dataCount,
        options: {}
    }
}



function generateTotal() {

    dataTotal = {
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




