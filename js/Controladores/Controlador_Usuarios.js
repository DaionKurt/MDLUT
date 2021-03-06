/**
 * Created by carlo on 07/04/2017.
 */
var app = angular.module('Usuarios', []);

app.controller('Datos_sesion',function ($scope, $http) {
    $scope.sesion = sesion;
    $scope.cargar = function (URL) {
        $http({
            method: "GET",
            url: URL
        }).then(function correcto(response) {
            $scope.informacion = response.data;
            $scope.pass_o = "";
            $scope.correo_o = $scope.informacion.Correo;
            $scope.telefono_o = $scope.informacion.Telefono;
            $scope.IDX = $scope.informacion.IDX;
            console.log($scope.informacion);
        },function error(response) {
            console.log("Error: "+response);
        });
    };
    $scope.cargar($scope.sesion===1?"../../src/Gestores/Medicos/informacion.php":"../../src/Gestores/Pacientes/informacion.php");
    $scope.edicion = false;
    $scope.error = false;
    $scope.edicion_foto = false;
    $scope.editar_foto = function () {
        $scope.edicion_foto = true;
    };
    $scope.editar_pass = function() {
        $scope.edicion = true;
    };
    $scope.cancelar_foto = function () {
        $scope.edicion_foto = false;
    };
    $scope.inhabilitar_edicion = function() {
        $scope.edicion = false;
    };
    $scope.cancelar = function() {
        $scope.nueva = $scope.pass_o;
        $scope.informacion.Correo = $scope.correo_o;
        $scope.informacion.Telefono = $scope.telefono_o;
        $scope.edicion = false;
        $scope.error = false;
        $scope.pass = "";
        document.getElementById('corroborar').style.display='none';
    };
    $scope.elimina = function () {
        $scope.eliminando = true;
        console.log($scope.IDX);
        $http({
            method: "POST",
            url: "../../src/Gestores/External/eliminar.php",
            data: { IDX: $scope.IDX}
        }).then(function correcto(response){
            console.log("BIEN");
            window.location = "../../index.php";
        },function error(response) {
            console.log($scope.IDX);
        });
    };
    $scope.guardar = function() {
        $http({
            method: 'POST',
            url: '../../src/BD/verificar.php',
            data: {pass: $scope.pass,
                nueva: $scope.nueva,
                correo: $scope.informacion.Correo,
                telefono: $scope.informacion.Telefono}
        }).then(function correcto(response) {
            $scope.correcto = typeof(response.data.correo) !== "undefined";
            if($scope.correcto){
                $scope.correo_o = response.data.correo;
                $scope.telefono_o = response.data.telefono;
                $scope.pass = "";
                $scope.edicion = false;
                document.getElementById('corroborar').style.display='none';
                document.getElementById('exito').style.display='block';
                console.log(response.data);
            }else{
                $scope.error = true;
            }
        }, function error(response) {
            console.log('Error: ' + response);
        });
    };
    $scope.abrir_modal = function() {
        document.getElementById('elimina_modal').style.display = "block";
    };
    $scope.cerrar_modal = function () {
        document.getElementById('elimina_modal').style.display = "none";
    };
});