/**
 * Created by carlo on 28/03/2017.
 */
var app = angular.module('Pacientes', []);

app.controller('Controlador_Estado', function($scope, $http) {
    $http({
        method: "GET",
        url: "../../src/Gestores/Pacientes/informacion.php"
    }).then(function (response) {
        $scope.informacion = response.data;
    });
});
app.controller('Controlador_Diagnostico', function($scope, $http) {
    $scope.glucosa_d = 120;
    $scope.estatura_d = 165;
    $scope.peso_d = 70;
    $scope.cargar = function () {
        $http({
            method: "GET",
            url: "../../src/Gestores/Pacientes/diagnosticos.php"
        }).then(function correcto(response) {
                $scope.diagnosticos = response.data.diagnosticos;
                $scope.existen = $scope.diagnosticos.length > 0;
                if ($scope.existen) {
                    $scope.ultimo = $scope.diagnosticos[$scope.diagnosticos.length - 1];
                }
            },function error(response) {
                console.log('Error: ' + response);
            }
        );
    };
    $scope.cargar();
    $scope.dame_fecha_actual = function(){
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1;
        var yyyy = today.getFullYear();
        if(dd<10) {dd='0'+dd}
        if(mm<10){mm='0'+mm}
        return dd+'/'+mm+'/'+yyyy;
    };
    $scope.iniciar_diagnostico = function() {
        document.getElementById("contenedor_analisis").style.display = "none";
        document.getElementById("animacion").style.display = "block";
        diagnosticar($scope,$http,{
            peso:$scope.peso_d,
            estatura:$scope.estatura_d,
            glucosa:$scope.glucosa_d,
            tiempo:$scope.tiempo,
            vision:$scope.vision,
            sed:$scope.sed,
            fatiga:$scope.fatiga,
            orina:$scope.orina,
            hambre:$scope.hambre,
            fecha:$scope.dame_fecha_actual()});
    };
    $scope.cargar_func = function () {
        document.getElementById('nuevo_diagnos').style.display='none';
        document.getElementById("contenedor_resultados").style.display = "none";
        document.getElementById("contenedor_analisis").style.display = "block";
        $scope.peso_d = 70;
        $scope.estatura_d = 165;
        $scope.glucosa_d = 120;
        $scope.tiempo = false;
        $scope.vision = false;
        $scope.sed = false;
        $scope.fatiga = false;
        $scope.orina = false;
        $scope.hambre = false;
    }
});
app.controller('Controlador_Citas', function($scope, $http) {
    $scope.correcto = false;
    $scope.error = false;
    $scope.cargar = function () {
        $http({
            method: "GET",
            url: "../../src/Gestores/Pacientes/citas.php"
        }).then(function correcto(response) {
                $scope.citas = response.data.citas;
                $scope.horarios = response.data.medicos;
                $scope.existen_citas = $scope.citas.length>0;
                $scope.existen_horarios = $scope.horarios.length>0;
                console.log($scope.horarios);
                $scope.ultima = $scope.citas[$scope.citas.length - 1];
            }
            ,function error(response) {
                console.log('Error: ' + response);
            });
    };
    $scope.cargar();
    $scope.crear_cita = function() {
        $http({
            method: "POST",
            url: "../../src/Gestores/Pacientes/crear_cita.php",
            data: { medico: $scope.medico.nombre.ND,
                horario: $scope.medico.horario,
                anotaciones: $scope.anotaciones}
        }).then(function correcto(response){
                $scope.correcto = true;
                $scope.cargar();
            },function error(response) {
                $scope.error = true;
            });
    };
    $scope.limpia = function () {
        $scope.correcto = false;
        $scope.error = false;
    }
});
app.controller('Controlador_Medicamentos', function($scope, $http) {
    $http({
        method: "GET",
        url: "../../src/Gestores/Pacientes/medicamentos.php"
    }).then(function (response) {
            $scope.recetas = response.data.recetas;
            $scope.medicamentos = response.data.medicamentos;
            $scope.existen_recetas = $scope.recetas.length > 0;
            $scope.existen_medicamentos = $scope.medicamentos.length > 0;
            if ($scope.existen_recetas) {
                $scope.ultima = $scope.recetas[$scope.recetas.length - 1];
            }
        },function error(response){
            console.log('Error: ' + response);
        });
});

function diagnosticar($scope,$http,$params){
    $http({
        method: "GET",
        url: "../../src/Gestores/Pacientes/generar_diagnostico.php",
        params: $params
    }).then(function correcto(response) {
            $scope.dato = response.data;
            document.getElementById("animacion").style.display = "none";
            document.getElementById("contenedor_resultados").style.display = "block";
            $scope.cargar();
        },function error(response){
            console.log('Error: ' + response);
        });
}