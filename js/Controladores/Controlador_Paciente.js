/**
 * Created by carlo on 28/03/2017.
 */
var app = angular.module('App', []);

app.controller('Controlador_Estado', function($scope, $http) {
    $http.get("../../src/Gestores/Consultas_Pacientes/informacion.php").then(function (response) {$scope.informacion = response.data;
    console.log($scope.informacion);});
    consulta($scope,$http,{inner:0,tabla_p:'usuario',tabla_s:'medico'});
});
app.controller('Controlador_Diagnostico', function($scope, $http) {
    $http.get("../../src/Gestores/Consultas_Pacientes/diagnosticos.php").then(
        function (response) {$scope.diagnosticos = response.data.diagnosticos;}
    );
});
app.controller('Controlador_Citas', function($scope, $http) {
    $http.get("../../src/Gestores/Consultas_Pacientes/citas.php").then(
        function (response) {$scope.citas = response.data.citas; console.log($scope.citas)});
});
app.controller('Controlador_Medicamentos', function($scope, $http) {
    $http.get("../../src/Gestores/Consultas_Pacientes/medicamentos.php").then(
        function (response) {$scope.recetas = response.data.recetas; $scope.medicamentos = response.data.medicamentos;});
});

function consulta($scope,$http,$test){
    var medicos = $http({url: "../../src/BD/consultor.php", method: "GET", params: $test});
    medicos.then(
        function( response ) {$scope.dato = response.data.registro;console.log( $scope.dato );},
        function( response ) {alert('error');}
    );
}