
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/angular-material.min.css">
    <link rel="stylesheet" href="../css/icon.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/angular.min.js"></script>
    <script src="../js/angular-animate.min.js"></script>
    <script src="../js/angular-aria.min.js"></script>
    <script src="../js/angular-messages.min.js"></script>
    <script src="../js/angular-material.min.js"></script>
</head>
<body data-ng-app="App">
<div data-ng-controller="ControladorA">
    <table>
        <tr data-ng-repeat="registro in datos">
            <td>{{ registro.Nombre}}</td>
            <td>{{ registro.Apellido }}</td>
            <td>{{ registro.Edad }}</td>
            <td>{{ registro.Correo }}</td>
        </tr>
    </table>
</div>
<div data-ng-controller="ControladorB">
    <table>
        <tr data-ng-repeat="registro in datos">
            <td>{{ registro.Nombre}}</td>
            <td>{{ registro.Descripcion }}</td>
            <td>{{ registro.Dosis }}</td>
            <td>{{ registro.Via }}</td>
        </tr>
    </table>
</div>
<!--
<form  data-ng-submit="registrar()">
    <fieldset>
        <div class="form-group">
            <input class="form-control" ng-model="txtUsuario" placeholder="Usuario" name="email" type="text" required>
        </div>
        <div class="form-group">
            <input class="form-control" ng-model="txtContrasena" placeholder="Contraseña" name="password" type="password" value=""required>
        </div>
        <div class="row">
            <div class="col-md-6">
                <input class="btn btn-lg btn-info btn-block" type="submit" value="Entrar">
            </div>
            <div class="col-md-6">
                <input class="btn btn-lg btn-default btn-block" ng-click="limpiar()" type="reset" value="Limpiar">
            </div>
        </div>
    </fieldset>
</form>


<form  ng-submit="entrar()">
    <fieldset>
        <div class="form-group">
            <input class="form-control" ng-model="txtUsuario" placeholder="Usuario" name="email" type="text" required>
        </div>
        <div class="form-group">
            <input class="form-control" ng-model="txtContrasena" placeholder="Contraseña" name="password" type="password" value=""required>
        </div>
        <div class="row">
            <div class="col-md-6">
                <input class="btn btn-lg btn-info btn-block" type="submit" value="Entrar">
            </div>
            <div class="col-md-6">
                <input class="btn btn-lg btn-default btn-block" ng-click="limpiar()" type="reset" value="Limpiar">
            </div>
        </div>
    </fieldset>
</form>-->


<script>
    var app = angular.module('App', []);
    app.controller('ControladorA', function($scope, $http) {
        $http.get("peticionesA.php").then(function (response) {$scope.datos = response.data.registro;});
    });
    app.controller('ControladorB', function($scope, $http) {
        $http.get("peticionesB.php").then(function (response) {$scope.datos = response.data.registro;});
    });
</script>


</body>
</html>