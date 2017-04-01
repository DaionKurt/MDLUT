/**
 * Created by carlo on 28/03/2017.
 */
var app = angular.module('App', []);

app.controller('Controlador_Estado', function($scope, $http) {
    $http.get("../../src/Gestores/Pacientes/informacion.php").then(function (response) {$scope.informacion = response.data;
    console.log($scope.informacion);});
});
app.controller('Controlador_Diagnostico', function($scope, $http) {
    $scope.glucosa_d = 120;
    $scope.estatura_d = 165;
    $scope.peso_d = 70;
    $scope.cargar = function () {
        $http.get("../../src/Gestores/Pacientes/diagnosticos.php").then(
            function (response) {
                $scope.diagnosticos = response.data.diagnosticos;
                $scope.existen = $scope.diagnosticos.length > 0;
                if ($scope.existen) {
                    $scope.ultimo = $scope.diagnosticos[$scope.diagnosticos.length - 1];
                }
            }
        );
    };
    $scope.cargar();
    $scope.iniciar_diagnostico = function() {
        document.getElementById("contenedor_analisis").style.display = "none";
        document.getElementById("animacion").style.display = "block";
        diagnosticar($scope,$http,{});
    };
});
app.controller('Controlador_Citas', function($scope, $http) {
    $scope.correcto = false;
    $scope.error = false;
    $scope.cargar = function () {
        $http.get("../../src/Gestores/Pacientes/citas.php").then(
            function (response) {
                $scope.citas = response.data.citas;
                $scope.horarios = response.data.medicos;
                console.log($scope.horarios);
                $scope.ultima = $scope.citas[$scope.citas.length - 1];
            });
    };
    $scope.cargar();
    $scope.crear_cita = function() {
        $http.post("../../src/Gestores/Pacientes/crear_cita.php",{ medico : $scope.medico.nombre.ND , horario : $scope.medico.horario })
            .success(function(data, status, headers, config){
                $scope.correcto = true;
                $scope.cargar();
                console.log("inserted Successfully");
            })
            .error(function(data) {
                $scope.error = true;
            });
    };
    $scope.limpia = function () {
        $scope.correcto = false;
        $scope.error = false;
    }
});
app.controller('Controlador_Medicamentos', function($scope, $http) {
    $http.get("../../src/Gestores/Pacientes/medicamentos.php").then(
        function (response) {$scope.recetas = response.data.recetas; $scope.medicamentos = response.data.medicamentos;
            $scope.ultima = $scope.recetas[$scope.recetas.length-1];});
});

function diagnosticar($scope,$http,$params){
    var medicos = $http({url: "../../src/BD/consultor.php", method: "GET", params: $params});
    medicos.then(
        function( response ) {
            $scope.dato = response.data.registro;
            console.log($scope.dato);
            document.getElementById("animacion").style.display = "none";
        },function( response ) {alert('error');}
    );
}