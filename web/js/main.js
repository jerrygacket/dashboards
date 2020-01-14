'use strict';

let baseUri = window.location.origin+'/web/';
window.chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(201, 203, 207)'
};

let colorNames = Object.keys(window.chartColors);

window.onload = function() {
    //let charts = getChartList();
    //let charts = document.getElementsByTagName('canvas');
    // getCharts('sales');
    getChartList(pageName);
    //console.log(chartList);
    //chartList.forEach(element => console.log(element));
    //getCharts(pageName);
};