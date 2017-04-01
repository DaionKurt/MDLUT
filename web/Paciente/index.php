<?php
session_start();
include('../../src/Entidades/Usuario.php');
include('../../src/Entidades/Paciente.php');
include('../../src/Entidades/Medico.php');
if(!isset($_SESSION['usuario']))
    header("location: ../../index.php");
$objeto = unserialize($_SESSION['objeto']);
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
        .w3-quarterr{float:left;width:24.9999%}
        .w3-input-inline{padding:8px;display:inline-block;border:none;border-bottom:1px solid #ccc;width:auto}
        .w3-input{padding: 0;}
        .w3-select{ padding:4px;}
        .w3-check{ width:17px; height:17px;}
    </style>
    <script src="../../js/Controladores/Controlador_Paciente.js"></script>
    <script type="text/javascript" src="../../js/loader.js"></script>
    <script type="text/javascript" src="../../js/Graficos/graficos.js"></script>
</head>
<body data-ng-app="App" onload="carga()">
<div id="loader"></div>
    <div id="contenido_web" class="animate-bottom">
        <div class="w3-sidebar w3-bar-block w3-animate-left sidebar" id="panel_lateral">
            <div align="center">
                <img src="../../img/imagenes/avatar.png" alt="" style="width: 50%;padding-top: 1em" class="w3-responsive w3-circle">
                <h2><?php echo $objeto->get_nombre()." ".$objeto->get_apellido();?></h2>
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
            <div align="center" class="w3-row w3-card-2" style="rgba(247, 247, 247, 0.27)">
                <img src="../../img/imagenes/Logo%20horizontal%20con%20texto.png" alt="" class="w3-responsive w3-animate-zoom" style="height: 7em;">
            </div>
            <div class="w3-container">
                    <h2>Bienvenido <?php echo $objeto->get_nombre()." ".$objeto->get_apellido();?></h2>
                <div class="w3-row" align="center">
                    <a href="javascript:void(0)" onclick="cambia_panel(event,'Estado');">
                        <div class="w3-quarterr enlace w3-bottombar w3-hover-light-gray w3-padding w3-border-red">Estado</div>
                    </a>
                    <a href="javascript:void(0)" onclick="cambia_panel(event,'Diagnostico');">
                        <div class="w3-quarterr enlace w3-bottombar w3-hover-light-gray w3-padding">
                            <script>
                                var mediaquery = window.matchMedia("(max-width: 600px)");
                                if (mediaquery.matches) {document.write("DX");} else {document.write("Diagnostico");}
                            </script>
                        </div>
                    </a>
                    <a href="javascript:void(0)" onclick="cambia_panel(event,'Citas');">
                        <div class="w3-quarterr enlace w3-bottombar w3-hover-light-gray w3-padding">Citas</div>
                    </a>
                    <a href="javascript:void(0)" onclick="cambia_panel(event,'Medicamentos');">
                        <div class="w3-quarterr enlace w3-bottombar w3-hover-light-gray w3-padding">Recetas</div>
                    </a>
                </div>
                <div id="Estado" class="w3-container contenedor" style="display: block;">
                    <h2>Estado</h2>
                    <div data-ng-include="'estado.html'"></div>
                </div>
                <div id="Diagnostico" class="w3-container contenedor" style="display: none">
                    <h2>Diagnostico</h2>
                    <div data-ng-include="'diagnostico.html'"></div>
                </div>
                <div id="Citas" class="w3-container contenedor" style="display: none;">
                    <h2>Citas</h2>
                    <div data-ng-include="'citas.html'"></div>
                </div>
                <div id="Medicamentos" class="w3-container contenedor" style="display: none;">
                    <h2>Recetas</h2>
                    <div data-ng-include="'recetas.html'"></div>
                </div>
            </div>
        </div>
        <footer class="w3-blue-grey" style="height: 10em;margin-top: 1em;">

        </footer>
    </div>
<script src="../../js/post_scripts.js"></script>
</body>
</html>