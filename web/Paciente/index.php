<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header("location: ../../index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Diaman | Paciente</title>
    <link rel="stylesheet" href="../../css/w3.css">
    <link rel="stylesheet" href="../../css/angular-material.min.css">
    <link rel="stylesheet" href="../../css/icon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/estilos.css">
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/angular.min.js"></script>
    <script src="../../js/angular-animate.min.js"></script>
    <script src="../../js/angular-aria.min.js"></script>
    <script src="../../js/angular-messages.min.js"></script>
    <script src="../../js/angular-material.min.js"></script>
    <script src="../../js/scripts.js"></script>
    <style>
        .sidebar{ display:none; z-index:3;}
        .contenido{margin-left: 3em;}
        .side-open{padding:0; width:100%; background-color: transparent !important; color: white !important;}
        #contenido_web{ color: #000;}
        #panel_lateral{width: 20em;}
    </style>
    <script src="../../js/Controladores/Controlador_Paciente.js"></script>
    <script type="text/javascript" src="../../js/loader.js"></script>
    <script type="text/javascript" src="../../js/Graficos/graficos.js"></script>
</head>
<body data-ng-app="App" onload="carga()">
<div id="loader"></div>
    <div id="contenido_web" class="animate-bottom">
        <div class="w3-sidebar w3-bar-block w3-animate-left sidebar" id="panel_lateral">
            <div align="center" data-ng-controller="Controlador">
                <img src="../../img/imagenes/avatar.png" alt="" style="width: 50%;padding-top: 1em" class="w3-responsive w3-circle">
                <h2>{{ datos.nombre+" "+datos.apellido}}</h2>
                <p>Datos del usuario bla bla</p>
            </div>
            <span onclick="cerrar_panel();" class="w3-button w3-display-topright w3-xlarge" id="cerrar">&times;</span>
            <a href="#" class="w3-bar-item w3-button">Enlace 1</a>
            <a href="#" class="w3-bar-item w3-button">Enlace 2</a>
            <a href="#" class="w3-bar-item w3-button">Enlace 3</a>
        </div>
        <div style="height: 100%;position: fixed;width: 3em; background-color: #1b1b1b" align="center">
            <button class="w3-button w3-white w3-xxlarge side-open" onclick="abrir_panel()">&#9776;</button>
            <a class="fa fa-bell-o" style="font-size:2em;color:white; margin-top: .5em;text-decoration: none" href="#"></a>
            <a class="fa fa-calendar" style="font-size:2em;color:white; margin-top: .5em;text-decoration: none" href="#"></a>
            <a class="fa fa-info-circle" style="font-size:2em;color:white; margin-top: .5em;text-decoration: none" href="#"></a>
            <a class="fa fa-sign-out" style="font-size:2em;color:white; margin-top: .5em;text-decoration: none" href="../../src/BD/cerrar_sesion.php"></a>
        </div>

        <div class="w3-overlay w3-animate-opacity" onclick="cerrar_panel()" style="cursor:pointer" id="contenido"></div>
        <div class="contenido">
            <div class="w3-container">
                <div data-ng-controller="Controlador">
                    <h1>Bienvenido {{ datos.nombre+" "+datos.apellido}}</h1>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur assumenda consequatur dolor inventore ipsam neque non odio repellendus, suscipit totam? Accusamus animi cupiditate dolorem eaque exercitationem impedit magni porro, quis.</p>
                <div class="w3-row">
                    <a href="javascript:void(0)" onclick="cambia_panel(event,'Estado');">
                        <div class="w3-quarter enlace w3-bottombar w3-hover-light-gray w3-padding w3-border-red">Estado</div>
                    </a>
                    <a href="javascript:void(0)" onclick="cambia_panel(event,'Diagnostico');">
                        <div class="w3-quarter enlace w3-bottombar w3-hover-light-gray w3-padding">Diagnostico</div>
                    </a>
                    <a href="javascript:void(0)" onclick="cambia_panel(event,'Citas');">
                        <div class="w3-quarter enlace w3-bottombar w3-hover-light-gray w3-padding">Citas</div>
                    </a>
                    <a href="javascript:void(0)" onclick="cambia_panel(event,'Medicamentos');">
                        <div class="w3-quarter enlace w3-bottombar w3-hover-light-gray w3-padding">Medicamentos</div>
                    </a>
                </div>
                <div id="Estado" class="w3-container contenedor" style="display: block; padding-left: 0;padding-right: 0">
                    <div data-ng-include="'estado.html'"></div>
                </div>
                <div id="Diagnostico" class="w3-container contenedor" style="display: none">
                    <h2>Diagnostico</h2>
                    <div data-ng-include="'diagnostico.html'"></div>
                </div>
                <div id="Citas" class="w3-container contenedor" style="display: none;">
                    <h2>Citas</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam aspernatur eligendi eum
                        expedita facere fugiat id, itaque laboriosam mollitia nam nisi non porro qui quia reprehenderit
                        sed tempora ullam voluptatum.</p>
                </div>
                <div id="Medicamentos" class="w3-container contenedor" style="display: none;">
                    <h2>Medicamentos</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci debitis dignissimos
                        ducimus, eaque esse id inventore iste, iusto libero modi nostrum quod quos recusandae repellat
                        repellendus, sed similique unde.</p>
                </div>
            </div>
        </div>
    </div>
<script src="../../js/post_scripts.js"></script>
</body>
</html>