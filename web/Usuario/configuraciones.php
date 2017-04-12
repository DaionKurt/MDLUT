<?php
session_start();
if(!isset($_SESSION['usuario']))
    header("location: ../../index.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Diaman | Configuración</title>
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
    <script src="../../js/Controladores/Controlador_Usuarios.js"></script>
    <script src="../../js/loader.js"></script>
    <style>
        .panel-usuario{
            width:100%;
            min-height: 17em;
            background-color: #37474f;
            color: #fff;
        }
        .panel-regreso{
            width:100%;
            min-height: 1em;
            background-color: #55666e;
            color: #fff;
        }
        .imagen-perfil{
            width: 17em;
            padding: 1em;
        }
    </style>
    <script>
        var sesion = <?php
                if(isset($_SESSION['medico'])){
                    echo 1;
                }else if(isset($_SESSION['paciente'])){
                    echo 0;
                }else echo -1;
            ?>;
    </script>
</head>
<body data-ng-app="Usuarios" onload="carga_config()">
<div id="loader2"></div>
    <div id="contenido_web" style="height: 100%;" class="animate-bottom" data-ng-controller="Datos_sesion">
        <div class="panel-regreso">
            <a data-ng-href={{sesion=='1'?"../Medico/index.php":"../Paciente/index.php"}} class="w3-button w3-large"><i class="fa fa-reply"></i> Regresar</a>
        </div>
        <div class="w3-card panel-usuario configuraciones">
            <div class="w3-row">
                <h1 style="padding-left: 1em"><i class="fa fa-gear"></i> Configuraciones</h1>
                <div class="w3-quarter" align="center">
                    <img src="../../img/imagenes/avatar.png"
                         onclick="document.getElementById('fotografia').style.display='block'"
                         alt="" class="w3-responsive w3-circle imagen-perfil">
                    <button class="w3-btn fa fa-camera-retro w3-large w3-blue" ng-click="editar_pass()"><p style="display: inline;
                    font-family: 'Calibri', sans-serif"> Editar foto</p></button>
                </div>
                <div class="w3-half" style="padding-left: 1em">
                    <h1>{{informacion.Nombre+" "+informacion.Apellido }}</h1>
                    <h3>{{informacion.Usuario+" | "+informacion.Correo}}</h3>
                    <div ng-hide="edicion">
                        <h4 style="display: inline-block; min-width: 120px"><i class="fa fa-lock"></i> Contraseña: </h4>  ********* <p></p>
                        <h4 style="display: inline-block; min-width: 120px"><i class="fa fa-at"></i> Correo: </h4> {{informacion.Correo}} <p></p>
                        <h4 style="display: inline-block; min-width: 120px"><i class="fa fa-phone"></i> Teléfono: </h4> {{informacion.Telefono}} <p></p>
                    </div>
                    <div ng-show="edicion">
                        <div class="w3-row">
                            <h4 style="display: inline-block; min-width: 120px"><i class="fa fa-lock"></i> Contraseña: </h4>
                            <input class="input-config w3-rest" type="password" data-ng-model="nueva" ng-show="edicion" title=""><p></p>
                        </div>
                        <div class="w3-row">
                            <h4 style="display: inline-block;min-width: 120px"> <i class="fa fa-at"></i> Correo: </h4>
                            <input class="input-config w3-rest" type="email" data-ng-model="informacion.Correo" ng-show="edicion" title=""><p></p>
                        </div>
                        <div class="w3-row">
                            <h4 style="display: inline-block;min-width: 120px"><i class="fa fa-phone"></i> Teléfono: </h4>
                            <input class="input-config w3-rest" type="tel" data-ng-model="informacion.Telefono" ng-show="edicion" title=""><p></p>
                        </div>
                    </div>
                </div>
                <div ng-hide="edicion" class="w3-quarter" style="padding-top: 1em;padding-left: 1em">
                    <button class="w3-btn fa fa-pencil w3-large w3-blue" ng-click="editar_pass()"><p style="display: inline;
                    font-family: 'Calibri', sans-serif"> Editar campos</p></button>
                </div>
                <div ng-show="edicion" class="w3-quarter" style="padding-top: 1em;padding-left: 1em">
                    <button class="w3-btn fa fa-pencil w3-large w3-green" onclick="document.getElementById('corroborar').style.display='block'">
                        <p style="display: inline; font-family: 'Calibri', sans-serif;"> Guardar</p></button>
                    <button class="w3-btn fa fa-close w3-large w3-red" ng-click="cancelar()">
                        <p style="display: inline; font-family: 'Calibri', sans-serif;"> Cancelar</p></button>
                </div>
                <br><br>
                <br>
                <div style="padding-left: 1em">
                    <h4>Datos no Alterables</h4>
                    <p><i class="fa {{informacion.Sexo=='M'?'fa fa-mars':'fa fa-venus'}}"></i> Sexo:
                        {{informacion.Sexo=="M"?"Masculino":"Femenino"}}</p>
                    <p><i class="fa fa-calendar"></i> Fecha de nacimiento: {{informacion.Fecha}}</p>
                    <p><i class="fa fa-id-badge"></i> Edad: {{informacion.Edad}}</p>
                </div>

            </div>
            <br><br>
            <div id="corroborar" class="w3-modal">
                <div class="w3-modal-content w3-animate-zoom" style="max-width: 450px">
                    <header class="w3-container w3-amber"><span ng-click="cancelar()" class="w3-button w3-display-topright">&times;</span>
                        <h4><i class="fa fa-shield"></i> Confirma contraseña </h4>
                    </header>
                    <div class="w3-container">
                        <p style="color: black"> Por favor, introduce tu contraseña actual para continuar con la operación</p>
                        <input class="w3-input w3-animate-input entrada" type="password" id="pass" data-ng-model="pass" title=""
                               placeholder="Contraseña actual" required><p></p>
                        <div ng-show="error" class="w3-panel w3-red">
                            <p>La contraseña es incorrecta</p>
                        </div>
                        <p></p>
                        <div align="center">
                            <button class="w3-btn fa fa-lock w3-large w3-khaki" ng-click="guardar()">
                                <p style="display: inline; font-family: 'Calibri', sans-serif;"> Aceptar</p></button>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <div id="exito" class="w3-modal">
                <div class="w3-modal-content w3-animate-zoom" style="max-width: 450px">
                    <header class="w3-container w3-green">
                        <span onclick="document.getElementById('exito').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                        <h4><i class="fa fa-shield"></i> Listo! </h4>
                    </header>
                    <div class="w3-container">
                        <p style="color: black"> Datos actualizados con éxito</p>
                    </div>
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
    <div id="fotografia" class="w3-modal" onclick="this.style.display='none'" align="center">
        <span class="w3-button w3-hover-red w3-xxlarge w3-display-topright">×</span>
        <img class="image-modal w3-animate-zoom" src="../../img/imagenes/avatar.png">
    </div>
<script src="../../js/post_scripts.js"></script>
</body>
</html>