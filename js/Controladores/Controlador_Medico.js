/**
 * Created by carlo on 09/04/2017.
 */
var app = angular.module("Medicos",[]);

app.controller('Controlador_Estado', function($scope, $http) {
    $http({
        method: "GET",
        url: "../../src/Gestores/Medicos/informacion.php"
    }).then(function (response) {
        $scope.informacion = response.data;
    });
});
app.controller('Controlador_Citas', function($scope, $http) {
    $scope.cargar = function () {
        $http({
            method: "GET",
            url: "../../src/Gestores/Medicos/citas.php"
        }).then(function correcto(response) {
                $scope.citas = response.data.citas;
                $scope.existen_citas = $scope.citas.length>0;
                $scope.hoy = $scope.dame_fecha_actual();
            }
            ,function error(response) {
                console.log('Error: ' + response);
            });
    };
    $scope.cargar();
    $scope.cambio = function(id) {
        var x = document.getElementById(id);
        var y = document.getElementsByClassName("cita_c");
        if (x.className.indexOf("w3-show") === -1) {
            for (i = 0; i < y.length; i++) {
                y[i].className = y[i].className.replace(" w3-show", "");
            }
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    };
    $scope.cambia_cita = function(categoria) {
        var i;
        var x = document.getElementsByClassName("cita");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        document.getElementById(categoria).style.display = "block";
    };
    $scope.dame_fecha_actual = function(){
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1;
        var yyyy = today.getFullYear();
        if(dd<10) {dd='0'+dd}
        if(mm<10){mm='0'+mm}
        return dd+'/'+mm+'/'+yyyy;
    };
    $scope.filtro = function (x) {
        return x.Dia===$scope.hoy;
    };
});
app.controller('Controlador_Expedientes', function($scope, $http) {
    $scope.cargar = function () {
        $http({
            method: "GET",
            url: "../../src/Gestores/Medicos/medicos.php"
        }).then(function correcto(response) {
                $scope.pacientes = response.data.pacientes;
                $scope.existen_pacientes = $scope.pacientes.length>0;
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
    }
});
app.controller('Controlador_Horarios',function ($scope,$http){
    $scope.dame_fecha_actual = function(){
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1;
        var yyyy = today.getFullYear();
        if(dd<10) {dd='0'+dd}
        if(mm<10){mm='0'+mm}
        return yyyy+'-'+mm+'-'+dd;
    };
    $scope.cargar = function () {
        $http({
            method: "GET",
            url: "../../src/Gestores/Medicos/horarios.php"
        }).then(function correcto(response) {
                $scope.horarios = response.data.horarios;
                $scope.hoy = $scope.dame_fecha_actual();
                $scope.existen_horarios = $scope.horarios.length>0;
                console.log($scope.hoy);
                console.log($scope.horarios);
            }
            ,function error(response) {
                console.log('Error: ' + response);
            });
    };
    $scope.cargar();
    $scope.registrar_horario = function () {
        $http({
            method: "POST",
            url: "../../src/Gestores/Medicos/crear_horario.php",
            data: { dia: $scope.dia,
                hora: document.getElementById("hora").value}
        }).then(function correcto(response){
            $scope.correcto = true;
            $scope.cargar();
        },function error(response) {
            $scope.error = true;
        });
        /*$scope.hora = document.getElementById("hora").value;
        console.log($scope.hora);
        console.log($scope.dia);*/
    }
});