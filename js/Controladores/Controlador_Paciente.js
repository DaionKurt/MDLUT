/**
 * Created by carlo on 28/03/2017.
 */
var app = angular.module('App', []);
app.controller('Controlador', function($scope, $http) {
    $http.get("../../src/Gestores/info_usuario.php").then(function (response) {$scope.datos = response.data;});
});
app.controller('Controlador_Estado', function($scope, $http) {
    $http.get("../../src/Gestores/info_usuario.php").then(function (response) {$scope.datos = response.data;});
});
app.controller('Controlador_Diagnostico', function($scope, $http) {
    $http.get("../Pruebas/peticionesB.php").then(function (response) {$scope.datos = response.data.registro;});
});
app.controller('Controlador_Citas', function($scope, $http) {
    $http.get("../Pruebas/peticionesB.php").then(function (response) {$scope.datos = response.data.registro;});
});
app.controller('Controlador_Medicamentos', function($scope, $http) {
    $http.get("../Pruebas/peticionesB.php").then(function (response) {$scope.datos = response.data.registro;});
});