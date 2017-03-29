/**
 * Created by carlo on 28/03/2017.
 */
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawVisualization);
function drawVisualization() {
    var data = google.visualization.arrayToDataTable([
        ['Niveles de Glucosa', 'Glucosa', 'IMC'],
        ['Jun',  1000,      400],
        ['Jul',  1170,      460],
        ['Ago',  660,       1120],
        ['Sep',  1030,      540]
    ]);
    var options = {
        title: 'Relación de diagnósticos',
        hAxis: {title: 'Niveles',  titleTextStyle: {color: '#333'}},
        vAxis: {minValue: 0},
        is3D: true,
        width: 600,
        height: 300
    };
    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}