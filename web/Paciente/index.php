<?php
session_start();
include('../../src/Entidades/Usuario.php');
include('../../src/Entidades/Paciente.php');
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
    <script src="../../js/Controladores/Controlador_Paciente.js"></script>
    <script type="text/javascript" src="../../js/loader.js"></script>
    <script type="text/javascript" src="../../js/Graficos/graficos.js"></script>
</head>
<body data-ng-app="App" onload="carga()">
<div id="loader"></div>
    <div id="contenido_web" class="animate-bottom">
        <div class="w3-sidebar w3-bar-block w3-animate-left sidebar" id="panel_lateral">
            <div align="center">
                <h2 style="background-color: #00acc1;margin-top: 0;padding-bottom: .3em;">Paciente</h2>
                <img src="../../img/imagenes/avatar.png" alt="" style="width: 50%;padding-top: 1em" class="w3-responsive w3-circle">
                <h2><?php echo $objeto->get_nombre()." ".$objeto->get_apellido();?></h2>
                <p style="background-color: #546e7a;"><?php echo $objeto->get_correo()."<br>".$objeto->get_usuario()?></p>
            </div>
            <span onclick="cerrar_panel();" class="w3-button w3-hov w3-display-topright w3-xlarge" id="cerrar"
            style="background-color: #00acc1;">&times;</span>
            <a href="#" class="w3-bar-item w3-button" style="text-align: center"
            <a href="#" class="w3-bar-item w3-button" style="text-align: center">Configuración <i class="	fa fa-gears"></i></a>
            <a class="w3-bar-item w3-button" style="text-align: center" onclick="cerrar_panel()">Cerrar sesión <i class="fa fa-sign-out"></i></a>
        </div>
        <div style="height: 100%;position: fixed;width: 3em; background-color: #37474f" align="center">
            <button class="w3-button w3-white w3-xxlarge side-open" onclick="abrir_panel()">&#9776;</button>
            <a class="fa fa-envelope-open-o tooltip" style="font-size:2em;color:white; margin-top: .5em;text-decoration: none" href="#">
                <span class="tooltiptext">Informes</span>
            </a>
            <a class="fa fa-info-circle tooltip" style="font-size:2em;color:white; margin-top: .5em;text-decoration: none" href="#"
               onclick="document.getElementById('informacion').style.display='block'">
                <span class="tooltiptext">Información relevante</span>
            </a>
            <a class="fa fa-sign-out tooltip" style="font-size:2em;color:white; margin-top: .5em;text-decoration: none" href="../../src/BD/cerrar_sesion.php">
                <span class="tooltiptext">Cerrar sesión</span>
            </a>
        </div>

        <div class="w3-overlay w3-animate-opacity" onclick="cerrar_panel()" style="cursor:pointer" id="contenido"></div>
        <div class="contenido">
            <div align="center" class="w3-row w3-card-2" style="rgba(247, 247, 247, 0.27);background-color: rgba(0,0,0,.015);">
                <img src="../../img/imagenes/Logo%20horizontal%20con%20texto.png" alt="" class="w3-responsive w3-animate-zoom" style="height: 7em;">
            </div>
            <div class="w3-container">
                    <h2>Bienvenido <?php echo $objeto->get_nombre()." ".$objeto->get_apellido();?></h2>
                <div class="w3-row" align="center">
                    <a href="javascript:void(0)" onclick="cambia_panel(event,'Estado');">
                        <div class="w3-quarterr enlace w3-bottombar w3-hover-light-gray w3-padding w3-border-red">Estado
                            <i class="fa fa-plus-square w3-hide-small"></i> </div>
                    </a>
                    <a href="javascript:void(0)" onclick="cambia_panel(event,'Diagnostico');">
                        <div class="w3-quarterr enlace w3-bottombar w3-hover-light-gray w3-padding">
                            <script>
                                var mediaquery = window.matchMedia("(max-width: 600px)");
                                if (mediaquery.matches) {document.write("DX ");} else {document.write("Diagnostico ");}
                            </script>
                            <i class="fa fa-user-md w3-hide-small"></i>
                        </div>
                    </a>
                    <a href="javascript:void(0)" onclick="cambia_panel(event,'Citas');">
                        <div class="w3-quarterr enlace w3-bottombar w3-hover-light-gray w3-padding">Citas
                            <i class="fa fa-address-book-o w3-hide-small"></i></div>
                    </a>
                    <a href="javascript:void(0)" onclick="cambia_panel(event,'Medicamentos');">
                        <div class="w3-quarterr enlace w3-bottombar w3-hover-light-gray w3-padding">Recetas
                            <i class="fa fa-th-large w3-hide-small"></i></div>
                    </a>
                </div>
                <div id="Estado" class="w3-container contenedor" style="display: block;">
                    <h2><i class="fa fa-plus-square"></i> Estado</h2>
                    <div data-ng-include="'estado.html'"></div>
                </div>
                <div id="Diagnostico" class="w3-container contenedor" style="display: none">
                    <h2> <i class="fa fa-user-md"></i> Diagnostico</h2>
                    <div data-ng-include="'diagnostico.html'"></div>
                </div>
                <div id="Citas" class="w3-container contenedor" style="display: none;">
                    <h2><i class="fa fa-address-book-o"></i> Citas</h2>
                    <div data-ng-include="'citas.html'"></div>
                </div>
                <div id="Medicamentos" class="w3-container contenedor" style="display: none;">
                    <h2><i class="fa fa-th-large"></i> Recetas</h2>
                    <div data-ng-include="'recetas.html'"></div>
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
    <div id="informacion" class="w3-modal">
        <div class="w3-modal-content w3-animate-zoom w3-card-4">
            <header class="w3-container w3-teal">
                <span onclick="document.getElementById('informacion').style.display='none'"
                      class="w3-button w3-display-topright">&times;</span>
                <h2>Información relevante</h2>
            </header>
            <div class="w3-container" style="max-height: 400px; overflow-y: scroll; overflow-x: hidden; color: #2e2e2e; text-align: justify">
                <h4>Vida con Diabetes</h4>
                Desde el año 2000, la diabetes mellitus en México es la primera causa de muerte entre las mujeres y la
                segunda entre los hombres. En 2010, esta enfermedad causó cerca de 83 000 muertes en el país.
                La diabetes es un padecimiento en el cual el azúcar (o glucosa) en la sangre se encuentra en un nivel
                elevado. Esto se debe a que el cuerpo no produce o no utiliza adecuadamente la insulina, una hormona que
                ayuda a que las células transformen la glucosa (que proviene de los alimentos) en energía. Sin la
                suficiente insulina, la glucosa se mantiene en la sangre y con el tiempo, este exceso puede tener complicaciones graves.
                <h5>¿Cómo afecta la diabetes a la salud?</h5>
                La diabetes mellitus aumenta el riesgo de cardiopatías y accidentes cerebrovasculares (como embolia). A
                demás, a largo plazo puede ocasionar:
                <ol>
                    <li>Ceguera (debido a las lesiones en los vasos sanguíneos de los ojos)</li>
                    <li>Insuficiencia renal (por el daño al tejido de los riñones)</li>
                    <li>Impotencia sexual (por el daño al sistema nervioso)</li>
                    <li>Amputaciones (por las lesiones que ocasiona en los pies)</li>
                    <li>Sin embargo, teniendo controlada la diabetes se pueden evitar o disminuir muchas de estas complicaciones.</li>
                </ol>
                <h5>¿Cómo prevenir la diabetes?</h5>
                La diabetes mellitus es una enfermedad que se origina debido a la combinación de diversos factores,
                entre los que se encuentran la edad, la obesidad, el sedentarismo, la alimentación inadecuada, los
                antecedentes familiares y algunos factores genéticos.
                Entre las estrategias que se pueden seguir individualmente para prevenir la aparición de diabetes se encuentran:
                <ol>
                    <li>Tener una alimentación alta en fibra</li>
                    <li>Moderar el consumo de los alimentos con alto contenido calórico y de carbohidratos</li>
                    <li>Realizar actividad física con regularidad</li>
                    <li>Mantener un peso saludable (para saber el peso ideal, consultar al médico o nutriólogo)</li>
                    <li>Moderar el consumo de alcohol</li>
                    <li>Disminuir los alimentos altos en grasas saturadas y grasas trans</li>
                    <li>Evitar las bebidas azucaradas y refrescos</li>
                    <li>No fumar</li>
                    <li>Levantarse unos minutos después de un periodo prolongado de estar sentado</li>
                    <li>Acudir periódicamente al médico para realizarse pruebas de glucosa en sangre</li>
                    <li></li>
                </ol>
                Los factores relacionados con el estilo de vida pueden modificarse con el objetivo de mejorar la salud
                de las personas y disminuir las posibilidades de desarrollar diabetes. Estas intervenciones pueden
                disminuir hasta en 31% la presentación de casos de diabetes mellitus 2.
                <h5>Mejora tu estilo de vida y protégete de la diabetes.</h5>
                <div align="right">
                    <button class="w3-btn w3-blue" onclick="document.getElementById('informacion').style.display='none'">
                        Entendido
                    </button>
                </div>
                <br>
            </div>
        </div>
    </div>
</body>
</html>