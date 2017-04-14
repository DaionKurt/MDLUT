<?php
session_start();
include('../../src/Entidades/Usuario.php');
include('../../src/Entidades/Administrador.php');
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
    <title>Diaman | Administrador</title>
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
        .sidebar{ display:none; z-index:3;background-color: #37474f;
            color: #fff;}
        .contenido{margin-left: 3em;}
        .side-open{padding:0; width:100%; background-color: transparent !important; color: white !important;}
        #contenido_web{ color: #000;}
        #panel_lateral{width: 20em;}
        .w3-quarterr{float:left;width:24.9999%}
        .w3-input-inline{padding:8px;display:inline-block;border:none;border-bottom:1px solid #ccc;width:auto}
        .w3-input{padding: 0;}
        .w3-select{ padding:4px;}
        .w3-check{ width:17px; height:17px;}
        .boxsizingBorder {
            width: 100%;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
    </style>
    <script src="../../js/Controladores/Controlador_Administrador.js"></script>
</head>
<body data-ng-app="Admon" onload="carga()">
<div id="loader"></div>
<div id="contenido_web" class="animate-bottom">
    <div style="height: 100%;position: fixed;width: 3em; background-color: #37474f" align="center">
        <a class="fa fa-sign-out tooltip" style="font-size:2em;color:white; margin-top: .5em;text-decoration: none" href="../../src/BD/cerrar_sesion.php">
            <span class="tooltiptext">Cerrar sesión</span>
        </a>
    </div>

    <div class="w3-overlay w3-animate-opacity" onclick="cerrar_panel()" style="cursor:pointer" id="contenido"></div>
    <div class="contenido">
        <div class="w3-row w3-card-2" style="rgba(247, 247, 247, 0.27);background-color: rgba(0,0,0,.015);">
            <img src="../../img/imagenes/Texto.png" alt="" class="w3-responsive w3-animate-zoom" style="float:left;height: 7em;">
            <h4 style="padding-top: 1em">Panel de Administrador <b> | </b><?php echo $objeto->get_nombre()." ".$objeto->get_apellido();?></h4>
        </div>
        <div class="w3-container">
            <p></p>
            <div class="w3-row" align="center">
                <a href="javascript:void(0)" onclick="cambia_panel(event,'Medicos');">
                    <div class="w3-third enlace w3-bottombar w3-hover-light-gray w3-padding w3-border-red">Medicos
                        <i class="fa fa-plus-square w3-hide-small"></i> </div>
                </a>
                <a href="javascript:void(0)" onclick="cambia_panel(event,'Pacientes');">
                    <div class="w3-third enlace w3-bottombar w3-hover-light-gray w3-padding">Pacientes
                        <i class="fa fa-address-book-o w3-hide-small"></i></div>
                </a>
                <a href="javascript:void(0)" onclick="cambia_panel(event,'Medicamentos');">
                    <div class="w3-third enlace w3-bottombar w3-hover-light-gray w3-padding">Medicamentos
                        <i class="fa fa-file-text-o w3-hide-small"></i></div>
                </a>
            </div>
            <div id="Medicos" class="w3-container contenedor" style="display: block;">
                <h2><i class="fa fa-plus-square"></i> Medicos</h2>
                <div data-ng-include="'medicos.html'"></div>
            </div>
            <div id="Pacientes" class="w3-container contenedor" style="display: none">
                <h2> <i class="fa fa-address-book-o"></i> Pacientes</h2>
                <div data-ng-include="'pacientes.html'"></div>
            </div>
            <div id="Medicamentos" class="w3-container contenedor" style="display: none;">
                <h2><i class="fa fa-file-text-o"></i> Medicamentos</h2>
                <div data-ng-include="'medicamentos.html'"></div>
            </div>
        </div>
    </div>
    <footer style="min-height: 5em;background-color: #262626;color:#666666 !important;border-top: 1px solid #22c4d6;">
        <div class="w3-row" style="margin-left: 4em">
            <div class="w3-half">
                <p>© Derechos Reservados 2017. Diabetes Manager and Analyzer | Versión 1.0 <br>
                    <i class="fa fa-street-view"></i> Carlos A. Fernández</p>
            </div>
            <div class="w3-half">
                <p><i class="fa fa-wrench"></i>
                    Si tienes algún problema con el sistema favor de reportarlo a: <br>carlosfdez@outlook.com</p>
            </div>
        </div>
    </footer>
</div>
<script src="../../js/post_scripts.js"></script>
</body>
</html>