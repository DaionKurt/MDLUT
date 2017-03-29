/**
 * Created by carlo on 28/03/2017.
 */
var app = angular.module('App', []);
app.controller('Controlador', function($scope, $http) {
    $http.get("../../src/Gestores/info_usuario.php").then(function (response) {$scope.datos = response.data;
    console.log($scope.datos);}
    );
});
app.controller('Controlador_Estado', function($scope, $http) {
    $http.get("../../src/Gestores/info_usuario.php").then(function (response) {$scope.datos = response.data;});
    var medicos = $http({
        url: "../../src/BD/consultor.php",
        method: "GET",
        params: {inner:0,tabla_p:'usuario',tabla_s:'medico'}
    });
    medicos.then(
        function( response ) {
            $scope.dato = response.data.registro;
            console.log( $scope.dato );
        },
        function( response ) {
            alert('error');
        }
    );
    var request = $http({
        url: "../../src/BD/consultor.php",
        method: "GET",
        params: {inner:0,tabla_p:'usuario',tabla_s:'medico'}
    });
    request.then(
        function( response ) {
            $scope.dato = response.data.registro;
            console.log( $scope.dato );
        },
        function( response ) {
            alert('error');
        }
    );
/*
    $http.get("../../src/BD/consultor.php",{params:{inner:0,tabla_p:"usuario",tabla_s:'medico'}}
    ).then(function (response) {$scope.regis = response.data;
        console.l-og($scope.regis);});*/
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