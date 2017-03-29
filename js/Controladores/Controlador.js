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
    $scope.rsJSON = [ ];
    $scope.iniciar = function() {
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
                console.log("Usuario encontrado");
                window.location = "index.php";
            }
        })
        .error(function(data) {
            console.log('Error: ' + data);
        });
}
function registrar_usuario($http,$scope){
    $http.post('src/BD/registro_usuario.php',{ nombre : $scope.nombre, apellido : $scope.apellido,
        correo: $scope.correo, usuario : $scope.usuario , pass : $scope.pass, telefono: $scope.telefono,
        sexo: $scope.sexo, edad: $scope.edad, fecha_nacimiento: $scope.fecha_nacimiento})
        .success(function(data) {
            if (typeof(data.usuario) === "undefined"){
                limpia_formulario($scope);
                console.log("Registro fallido");
            }else{
                $scope.rsJSON = data.usuario;
                console.log("Registro correcto");
            }
        })
        .error(function(data) {
            console.log('Error: ' + data);
        });
}