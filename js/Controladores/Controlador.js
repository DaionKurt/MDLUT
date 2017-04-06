var app = angular.module("Aplicacion", []);
app.controller("InicioSesion",function ($scope,$http) {
    $scope.inicio_correcto = true;
    $scope.rsJSON = [ ];
    $scope.iniciar = function() {
        consultar_usuario($http,$scope);
    };
    $scope.limpiar = function() {
        limpia_formulario($scope);
    };
});
app.controller("RegistroUsuario",function ($scope,$http) {
    $scope.registrar = function() {
        registrar_usuario($http,$scope);
    };
    $scope.limpiar = function() {
        limpia_formulario($scope);
    };
});
function limpia_formulario($scope){
    $scope.usuario = '';
    $scope.pass = '';
    console.log("Se limpio");
}
function consultar_usuario($http,$scope){
    $http.post('src/BD/inicio_sesion.php',{ usuario : $scope.usuario , pass : $scope.pass })
        .success(function(data) {
            if (typeof(data.usuario) === "undefined"){
                limpia_formulario($scope);
                $scope.inicio_correcto = false;
                console.log("Inicio incorrecto");
            }else{
                $scope.rsJSON = data.usuario;
                console.log($scope.rsJSON);
                console.log("Usuario encontrado");
                window.location = "index.php";
            }
        })
        .error(function(data) {
            console.log('Error: ' + data);
        });
}
function registrar_usuario($http,$scope){
    $scope.correcto = false;
    $scope.error = false;
    $http.post('src/BD/registro_usuario.php',{ nombre : $scope.nombre_r, apellido : $scope.apellido_r,
        correo: $scope.correo_r, usuario : $scope.usuario_r , pass : $scope.pass_r, telefono: $scope.telefono_r,
        sexo: $scope.sexo_r, edad: $scope.edad_r, fecha_nacimiento: $scope.fecha_r})
        .success(function(data) {
            limpia_formulario($scope);
            $scope.correcto = true;
            console.log("Registro correcto");
        })
        .error(function(data) {
            $scope.error = true;
            console.log('Error: ' + data);
        });
}