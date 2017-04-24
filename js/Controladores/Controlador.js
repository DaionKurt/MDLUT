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
        $scope.limpiar();
        document.getElementById('inicio_sesion').style.display='none';
        $scope.inicio_correcto = true;
        $scope.usuario_activo = true;
    };
});
app.controller("RegistroUsuario",function ($scope,$http) {
    $scope.cargando = false;
    $scope.registrar = function() {
        $scope.cargando = true;
        registrar_usuario($http,$scope);
    };
    $scope.limpiar = function() {
        limpia_formulario($scope);
    };
    $scope.cerrar_ventana = function () {
        $scope.limpiar();
        document.getElementById('registro_usuario').style.display='none';
        $scope.cargando = false;
        $scope.correcto = false;
        $scope.error = false;
    };
});
app.controller("IngresoAdmon",function ($scope,$http) {
    $scope.inicio_correcto = true;
    $scope.rsJSON = [];
    $scope.iniciar = function() {
        consultar_admon($http,$scope);
        $scope.inicio_correcto = true;
    };
    $scope.limpiar = function() {
        limpia_formulario($scope);
    };
    $scope.cerrar_ventana_inicio = function () {
        document.getElementById('ingreso_admon').style.display='none';
        $scope.inicio_correcto = true;
    }
});
var aor = angular.module("Register",[]);
aor.controller("RegistroMedico",function ($scope,$http) {
    $scope.correcto = false;
    $scope.error = false;
    $scope.cargando = false;
    $scope.registrar = function() {
        console.log($scope.cargando);
        $scope.cargando = true;
        console.log($scope.cargando);
        registrar_medico($http,$scope);
    };
    $scope.cerrar_ventana_inicio = function () {
        document.getElementById('inicio_sesion').style.display='none';
        $scope.error = true;
        $scope.correcto = true;
    }
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
        $scope.cargando = false;
        $scope.correcto = true;
    }, function error(response) {
        $scope.cargando = false;
        $scope.error = true;
    });
}

function consultar_admon($http,$scope) {
    $http({
        method: 'POST',
        url: 'src/BD/sesion_administrador.php',
        data: {usuario:$scope.usuario,
            pass:$scope.pass}
    }).then(function correcto(response) {
        if (typeof(response.data.usuario) === "undefined"){
            limpia_formulario($scope);
            $scope.inicio_correcto = false;
        }else{
            window.location = "index.php";
        }
    }, function error(response) {
        console.log('Error: ' + response);
    });
}

function consultar_usuario($http,$scope){
    console.log($scope.usuario);
    console.log($scope.pass);
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
        $scope.cargando = false;
        limpia_formulario($scope);
        $scope.correcto = true;
    }, function error(response) {
        limpia_formulario($scope);
        $scope.error = true;
    });
}
function limpia_formulario($scope){
    $scope.nombre_r='';
    $scope.apellido_r='';
    $scope.correo_r='';
    $scope.usuario='';
    $scope.pass='';
    $scope.usuario_r='';
    $scope.pass_r='';
    $scope.telefono_r='';
    $scope.sexo_r='';
    $scope.edad_r='';
    $scope.fecha_nacimiento_r='';
    $scope.correcto = false;
    $scope.error = false;
    $scope.cargando = false;
}