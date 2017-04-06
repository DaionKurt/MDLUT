/**
 * Created by carlo on 28/03/2017.
 */
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawVisualization);
function drawVisualization() {
    var jsonData = $.ajax({
        url: "../../src/Gestores/Pacientes/chart.php",
        dataType: "json",
        async: false
    }).responseText;
    var options = {
        title: 'Relación de diagnósticos',
        hAxis: {title: 'Diagnósticos',  titleTextStyle: {color: '#333'}},
        vAxis: {minValue: 0},
        is3D: true,
        width: 600,
        height: 300,
        colors: ['#25a7e0', '#00b139']
    };
    var data = new google.visualization.DataTable(jsonData);
    var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
    chart.draw(data,options);
}