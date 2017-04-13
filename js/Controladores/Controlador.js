var app = angular.module("Aplicacion", []);
app.controller("InicioSesion",function ($scope,$http) {
    $scope.inicio_correcto = true;
    $scope.usuario_activo = true;
    $scope.rsJSON = [];
    $scope.iniciar = function() {
        consultar_usuario($http,$scope);
        $scope.inicio_correcto = true;
        $scope.usuario_activo = true;
    };
    $scope.limpiar = function() {
        limpia_formulario($scope);
    };
    $scope.cerrar_ventana_inicio = function () {
        document.getElementById('inicio_sesion').style.display='none';
        $scope.inicio_correcto = true;
        $scope.usuario_activo = true;
    }
});
app.controller("RegistroUsuario",function ($scope,$http) {
    $scope.registrar = function() {
        registrar_usuario($http,$scope);
    };
    $scope.limpiar = function() {
        limpia_formulario($scope);
    };
});
var aor = angular.module("Register",[]);
aor.controller("RegistroMedico",function ($scope,$http) {
    $scope.correcto = false;
    $scope.error = false;
    $scope.registrar = function() {
        registrar_medico($http,$scope);
    };
});

function registrar_medico($http,$scope){
    $scope.correcto = false;
    $scope.error = false;
    $http({
        method: 'POST',
        url: 'src/BD/registro_medico.php',
        data: {nombre: $scope.nombre_r,
            apellido: $scope.apellido_r,
            correo: $scope.correo_r,
            usuario: $scope.usuario_r,
            pass: $scope.pass_r,
            telefono: $scope.telefono_r,
            sexo: $scope.sexo_r,
            edad: $scope.edad_r,
            fecha_nacimiento: $scope.fecha_r,
            grado:$scope.grado_r,
            especialidad:$scope.especialidad_r,
            cedula:$scope.cedula_r,
            universidad:$scope.universidad_r
        }
    }).then(function correcto(response) {
        limpia_formulario($scope);
        $scope.correcto = true;
    }, function error(response) {
        $scope.error = true;
    });
}

function consultar_usuario($http,$scope){
    $http({
        method: 'POST',
        url: 'src/BD/inicio_sesion.php',
        data: {usuario:$scope.usuario,
            pass:$scope.pass}
    }).then(function correcto(response) {
        if (typeof(response.data.usuario) === "undefined"){
            if(response.data.Activo==="NO"){
                $scope.usuario_activo = false;
            }else{
                limpia_formulario($scope);
                $scope.inicio_correcto = false;
            }
        }else{
            window.location = "index.php";
        }
    }, function error(response) {
        console.log('Error: ' + response);
    });
}
function registrar_usuario($http,$scope){
    $scope.correcto = false;
    $scope.error = false;
    $http({
        method: 'POST',
        url: 'src/BD/registro_usuario.php',
        data: {nombre: $scope.nombre_r,
            apellido: $scope.apellido_r,
            correo: $scope.correo_r,
            usuario: $scope.usuario_r,
            pass: $scope.pass_r,
            telefono: $scope.telefono_r,
            sexo: $scope.sexo_r,
            edad: $scope.edad_r,
            fecha_nacimiento: $scope.fecha_r}
    }).then(function correcto(response) {
        limpia_formulario($scope);
        $scope.correcto = true;
    }, function error(response) {
        $scope.error = true;
    });
}
function limpia_formulario($scope){
    $scope.usuario = '';
    $scope.pass = '';
}