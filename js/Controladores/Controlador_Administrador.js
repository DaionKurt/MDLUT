/**
 * Created by carlo on 13/04/2017.
 */
var app = angular.module("Admon",[]);
app.controller('Controlador_Estado', function($scope, $http) {
    $http({
        method: "GET",
        url: "../../src/Gestores/Medicos/informacion.php"
    }).then(function (response) {
        $scope.informacion = response.data;
    });
});
app.controller("Controlador_Medicos",function($scope,$http) {
    $scope.cargar = function () {
        $http({
            method: "GET",
            url: "../../src/Gestores/Administrador/medicos.php"
        }).then(function correcto(response) {
                $scope.medicos = response.data.medicos;
                $scope.medicos_pendientes = response.data.pendientes;
                $scope.existen_medicos = $scope.medicos.length>0;
                $scope.existen_medicos_pendientes = $scope.medicos_pendientes.length>0;
                $scope.eliminando = false;
                console.log($scope.medicos);
            }
            ,function error(response) {
                console.log('Error: ' + response);
            });
    };
    $scope.cargar();
    $scope.modal = function(modal) {
        document.getElementById(modal).style.display = "block";
    };
    $scope.cerrar_modal = function (modal) {
        document.getElementById(modal).style.display = "none";
    };
    $scope.modal_eliminar = function(modal) {
        document.getElementById(modal).style.display = "block";
    };
    $scope.cerrar_modal_eliminar = function (modal) {
        document.getElementById(modal).style.display = "none";
    };
    $scope.activar = function (IDX) {
        $http({
            method: "POST",
            url: "../../src/Gestores/Administrador/activar_medico.php",
            data: { IDX: IDX}
        }).then(function correcto(response){
            $scope.cargar();
        },function error(response) {
            console.log(IDX);
        });
    };
    $scope.eliminar = function (IDX) {
        $scope.eliminando = true;
        eliminar(IDX,$http,$scope);
    }
});
app.controller("Controlador_Pacientes",function ($scope,$http){
    $scope.cargar = function () {
        $http({
            method: "GET",
            url: "../../src/Gestores/Administrador/pacientes.php"
        }).then(function correcto(response) {
                $scope.pacientes = response.data.pacientes;
                $scope.existen_pacientes = $scope.pacientes.length>0;
                $scope.eliminando = false;
                console.log($scope.pacientes);
            }
            ,function error(response) {
                console.log('Error: ' + response);
            });
    };
    $scope.cargar();
    $scope.modal = function(modal) {
        document.getElementById(modal).style.display = "block";
    };
    $scope.cerrar_modal = function (modal) {
        document.getElementById(modal).style.display = "none";
    };
    $scope.eliminar = function (IDX) {
        $scope.eliminando = true;
        eliminar(IDX,$http,$scope);
    }
});
app.controller("Controlador_Medicinas",function ($scope,$http) {
    $scope.cargar = function () {
        $http({
            method: "GET",
            url: "../../src/Gestores/Administrador/medicinas.php"
        }).then(function correcto(response) {
                $scope.medicamentos = response.data.medicamentos;
                $scope.existen_medicamentos = $scope.medicamentos.length>0;
                console.log($scope.medicamentos);
            }
            ,function error(response) {
                console.log('Error: ' + response);
            });
    };
    $scope.cargar();
    $scope.registrar_medicamento = function () {
        $scope.correcto = false;
        $scope.error = false;
        $http({
            method: "POST",
            url: "../../src/Gestores/Administrador/crear_medicamento.php",
            data: {
                nombre: $scope.nombre_m,
                informacion: $scope.informacion_m,
                dosis: $scope.dosis_m,
                via_administracion: $scope.via_administracion_m
            }
        }).then(function correcto(response) {
            if(typeof(response.data.error) === "undefined"){
                $scope.correcto = true;
                $scope.error = false;
                $scope.cargar();
            }else{
                $scope.correcto = false;
                $scope.error = true;
            }
            console.log(response);
        }, function error(response) {
            $scope.correcto = false;
            $scope.error = true;
        });
    }
});

function eliminar(IDX,$http,$scope) {
    $http({
        method: "POST",
        url: "../../src/Gestores/Administrador/eliminar.php",
        data: { IDX: IDX}
    }).then(function correcto(response){
        $scope.cargar();
    },function error(response) {
        console.log(IDX);
    });
}