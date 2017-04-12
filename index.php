<?php
session_start();
if(isset($_SESSION['usuario'])){
    if(isset($_SESSION['paciente'])){
        header("location: web/Paciente/index.php");
    }
    if(isset($_SESSION['medico'])){
        header("location: web/Medico/index.php");
    }
}
?>
<!doctype html>
<html lang="en" data-ng-app="Aplicacion">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Diaman | Inicio</title>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/angular-material.min.css">
    <link rel="stylesheet" href="css/icon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script src="js/angular-animate.min.js"></script>
    <script src="js/angular-aria.min.js"></script>
    <script src="js/angular-messages.min.js"></script>
    <script src="js/angular-material.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/Controladores/Controlador.js"></script>
    <style>
        .w3-animate-opacity{  -webkit-animation: opac 1.5s;  animation: opac 1.5s;  }
        .w3-animate-top{  -webkit-animation: animatetop 1.4s;  animation: animatetop 1.4s;  }
        .w3-input{padding: 0;}
        .w3-select{ padding:4px;}
        .w3-check{ width:17px; height:17px;}
        .mySlides {display:none;}
        .blue{
            color: #fff;
            background:linear-gradient(135deg,rgba(23, 151, 225,.9),rgba(89, 196, 98,0.9)),url("img/imagenes/diabetes.jpg");
            background-size:cover;
            background-attachment: fixed;
        }
        .orange{
            color: #fff;
            background:linear-gradient(135deg,rgba(243, 83, 105,.9),rgba(252, 216, 114,0.9)),url("img/imagenes/diabetes.jpg");
            background-size:cover;
            background-attachment: fixed;
        }
    </style>
</head>
<body>
<div class="w3-top">
    <div class="w3-bar w3-card" id="navegacion">
        <a href="#inicio" class="w3-bar-item w3-button">Inicio</a>
        <a href="#nosotros" class="w3-bar-item w3-button w3-hide-small">Nosotros</a>
        <a href="#info" class="w3-bar-item w3-button w3-hide-small">Información</a>
        <a href="#instituciones" class="w3-bar-item w3-button w3-hide-small">Instituciones</a>
        <a href="#acerca" class="w3-bar-item w3-button w3-hide-small">Acerca de</a>
        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="toggleFunction()">&#9776;</a>
    </div>
    <div id="menor" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium">
        <a href="#nosotros" class="w3-bar-item w3-button">Nosotros</a>
        <a href="#info" class="w3-bar-item w3-button">Información</a>
        <a href="#instituciones" class="w3-bar-item w3-button">Instituciones</a>
        <a href="#acerca" class="w3-bar-item w3-button">Acerca de</a>
    </div>
</div>
<div class="fondo-parallax fondo-principal w3-display-container w3-animate-opacity" id="inicio">
    <div class="w3-display-middle opacidad" style="white-space: nowrap;">
        <img src="img/imagenes/Logo%20con%20texto.png" alt="" class="logo w3-animate-top">
    </div>
    <div class="w3-display-bottommiddle " style="white-space: nowrap;">
        <button onclick="document.getElementById('inicio_sesion').style.display='block'"
                class="w3-button w3-dark-grey w3-hover-blue btn-espacio btn-inicio-sesion">Iniciar sesión</button>
        <br>
        <button onclick="document.getElementById('registro_usuario').style.display='block'"
                class="w3-button w3-black w3-hover-green btn-espacio">Registrar nuevo usuario</button>
    </div>
</div>

<div class="w3-row elementos-moviles" id="nosotros">
    <div class="w3-col m4 w3-center w3-hide-small" style="height:100%;">
        <div class="imagen-lateral w3-dark-grey" style="height:100%;">
            <img src="http://lorempixel.com/400/800/city/" style="margin-bottom: 0;">
            <!--<pre>< Imagen ></pre>-->
        </div>
    </div>
    <div class="w3-col s12 m8 w3-center w3-content w3-container w3-padding-64">
        <h3 class="w3-center">Qué es el sistema</h3>
        <p class="w3-center"><em>Cuida tu diabetes</em></p>
        <p class="slideanim">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. In velit esse culla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
            qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <br>
        <div class="w3-row">
            <div class="w3-quarter">
                <i class="fa fa-line-chart slideanim" style="font-size:36px"></i>
                <p class="slideanim">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquam doloribus impedit libero reiciendis repudiandae! Animi atque dolore ea fuga illo iste maiores minima nobis perspiciatis sed, sit tempora temporibus?</p>
            </div>
            <div class="w3-quarter">
                <i class="fa fa fa-venus-mars slideanim" style="font-size:36px"></i>
                <p class="slideanim">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquam doloribus impedit libero reiciendis repudiandae! Animi atque dolore ea fuga illo iste maiores minima nobis perspiciatis sed, sit tempora temporibus?</p>
            </div>
            <div class="w3-quarter">
                <i class="fa fa-user-md slideanim" style="font-size:36px"></i>
                <p class="slideanim">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquam doloribus impedit libero reiciendis repudiandae! Animi atque dolore ea fuga illo iste maiores minima nobis perspiciatis sed, sit tempora temporibus?</p>
            </div>
            <div class="w3-quarter">
                <i class="fa fa-hospital-o slideanim" style="font-size:36px"></i>
                <p class="slideanim">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquam doloribus impedit libero reiciendis repudiandae! Animi atque dolore ea fuga illo iste maiores minima nobis perspiciatis sed, sit tempora temporibus?</p>
            </div>
        </div>
    </div>
</div>

<div class="blue elementos-moviles">
    <div class="w3-content w3-container w3-padding-64 w3-center" id="info" style="z-index: 2;">
        <h3>La Diabetes</h3>
        <p><em>Qué es? datos de relevancia</em></p>
        <p class="slideanim">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do e. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
            qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <div class="w3-content w3-display-container w3-section slideanim" style="max-width:500px">
            <div class="w3-display-container mySlides w3-card-4">
                <img class="w3-animate-left" src="imagenes/BG1.png" style="min-height:100%; width:100%; margin-bottom: -1em"">
                <div class="w3-display-topleft w3-large w3-container w3-padding-16 w3-blue">
                    Chequeo constante
                </div>
            </div>
            <div class="w3-display-container mySlides w3-card-4">
                <img class="w3-animate-left" src="imagenes/BG2.jpg" style="min-height:100%; width:100%; margin-bottom: -1em"">
                <div class="w3-display-topright w3-large w3-container w3-padding-16 w3-orange" style="color: white !important;">
                    Buena alimentación
                </div>
            </div>
            <div class="w3-display-container mySlides w3-card-4">
                <img class="w3-animate-left" src="imagenes/BG3.jpg" style="min-height:100%; width:100%; margin-bottom: -1em">
                <div class="w3-display-bottomleft w3-large w3-container w3-padding-16 w3-green">
                    Ejercicio regular
                </div>
            </div>
        </div>
        <script>
            var myIndex = 0;
            carousel();
            function carousel() {
                var i;
                var x = document.getElementsByClassName("mySlides");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                myIndex++;
                if (myIndex > x.length) {myIndex = 1}
                x[myIndex-1].style.display = "block";
                setTimeout(carousel, 9000); // Change image every 2 seconds
            }
        </script>
    </div>
</div>

<div class="w3-white elementos-moviles">
    <div class="w3-content w3-container w3-padding-64" id="instituciones" style="z-index: 2;">
        <h3 style="max-width: 300px; padding-left: 1em" class="w3-blue-grey">Instituciones relacionadas</h3>
        <div class="w3-row">
            <p style="text-align: justify">Desde el año 2000, la diabetes mellitus en México es la primera causa de
            muerte entre las mujeres y la segunda entre los hombres. En 2010, esta enfermedad causó cerca de 83 000
            muertes en el país. Es por esto que desde entonces se han generado instituciones que pueden asesorarte,
            apoyarte y brindarte toda la información necesaria para que conozcas a fondo de la diabetes, cómo prevenirla
            y cómo vivir con ella</p>
        </div>
        <div class="w3-row-padding">
            <div class="w3-third">
                <img src="imagenes/FMD.png" alt="" style="max-width: 100%" class="w3-responsive slideanim">
                <p style="text-align: justify">La Federación Mexicana de Diabetes, A.C. (por sus siglas FMD) es una
                    Asociación Civil que vela por los intereses de las personas que viven con esta condición. La FMD
                    ofrece atención a pacientes, tanto en el ámbito de la salud como en el de apoyo.</p>
                <div align="center">
                    <a class="w3-btn w3-blue slideanim" href="http://fmdiabetes.org/">Sitio web</a><br>
                </div>
            </div>
            <div class="w3-third">
                <img src="imagenes/AMD.png" alt="" style="max-width: 100%" class="w3-responsive slideanim">
                <p style="text-align: justify">La Asociación Mexicana de Diabetes es una Institución que brinda atención,
                    educación y capacitación sobre el cuidado de la diabetes a las personas que viven con este padecimiento
                    y a sus familiares, con la finalidad de prevenir complicaciones y procurarles una mejor calidad de vida. </p>
                <div align="center">
                    <a class="w3-btn w3-red slideanim" href="http://amdiabetes.org/">Sitio web</a><br>
                </div>
            </div>
            <div class="w3-third">
                <img src="imagenes/ANS.png" alt="" style="max-width: 100%" class="w3-responsive slideanim">
                <p style="text-align: justify">Como una extensión del Instituto Nacional de Salud Pública, existe un
                módulo de atención dedicado al paciente con diabetes, que permite su orientación y cuidados para
                llevar una vida saludable dentro de los parámetros, así como asistencia médica gratuita, y grupos de apoyo.
                </p>
                <div align="center">
                    <a class="w3-btn w3-green slideanim" href="https://www.insp.mx/avisos/3652-diabetes-en-mexico.html">Sitio web</a><br>
                </div>
            </div>
        </div>
        <div class="w3-row">
            <div class="w3-third">

            </div>
            <div class="w3-third">

            </div>
            <div class="w3-third">

            </div>
        </div>
    </div>
</div>

<div class="orange elementos-moviles">
    <div class="w3-content w3-container w3-padding-64 w3-center" id="acerca" style="z-index: 2;">
        <h3>La Diabetes</h3>
        <p><em>Qué es? datos de relevancia</em></p>
        <p class="slideanim">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
            qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <div class="w3-row">
            <div class="w3-third w3-card-4 slideanim" style="overflow: hidden;">
                <img src="imagenes/IMG1.jpg" alt="" style="width:100%; margin-bottom: -1em">
            </div>
            <div class="w3-third w3-card-4 slideanim" style="overflow: hidden;">
                <img src="imagenes/IMG2.jpg" alt="" style="width:100%; margin-bottom: -1em">
            </div>
            <div class="w3-third w3-card-4 slideanim" style="overflow: hidden;">
                <img src="imagenes/IMG3.jpg" alt=""  style="width:100%; margin-bottom: -1em">
            </div>
        </div>
    </div>
</div>
<footer style="min-height: 5em;background-color: #262626;color:rgba(238, 238, 238, 0.61) !important;border-top: 1px solid #22c4d6;">
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

<div id="inicio_sesion" class="w3-modal" data-ng-controller="InicioSesion">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
        <header class="w3-container w3-teal">
            <span onclick="document.getElementById('inicio_sesion').style.display='none'"
                  class="w3-button w3-display-topright w3-xlarge" id="cerrar">&times;</span>
            <h2>Inicio de sesión</h2>
        </header>
        <div class="w3-container">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias atque autem deleniti doloremque iste nobis non, possimus sed!</p>
            <form class="w3-container" data-ng-submit="iniciar()">
                <label for="usuario">Usuario</label>
                <input class="w3-input w3-animate-input entrada" type="text" id="usuario" data-ng-model="usuario" required><p></p>
                <label for="pass">Contraseña</label>
                <input class="w3-input w3-animate-input entrada" type="password" id="pass" data-ng-model="pass" required><p></p>
                <div class="w3-panel w3-red w3-display-container w3-card-2" data-ng-hide="inicio_correcto">
                    <h3>Oh vaya! :(</h3>
                    <p>Lo siento pero los datos proporcionados no son correctos. Inténtalo de nuevo.</p>
                </div>
                <div align="right">
                    <button class="w3-btn" style="background-color: #007c6e; color: white;" type="reset" data-ng-click="limpiar()">Limpiar campos</button>
                    <button class="w3-btn" style="background-color: #007c6e; color: white;" type="submit">Iniciar sesión</button><p></p>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="registro_usuario" class="w3-modal" data-ng-controller="RegistroUsuario">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:700px">
        <header class="w3-container w3-blue-gray">
            <span onclick="document.getElementById('registro_usuario').style.display='none'"
                  class="w3-button w3-display-topright w3-xlarge">&times;</span>
            <h2>Registro de Usuario</h2>
        </header>
        <div class="w3-container">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias atque autem deleniti doloremque iste nobis non, possimus sed!</p>
            <form class="w3-container" data-ng-submit="registrar()">
                <div class="w3-row">
                    <div class="w3-half" style="padding-right: 1em">
                        <label for="nombre_r">Nombre</label>
                        <input class="w3-input w3-animate-input entrada" type="text" id="nombre_r" data-ng-model="nombre_r" required>
                    </div>
                    <div class="w3-half">
                        <label for="apellido_r">Apellido</label>
                        <input class="w3-input w3-animate-input entrada" type="text" id="apellido_r" data-ng-model="apellido_r" required>
                    </div>
                </div>
                <div class="w3-row">
                    <div class="w3-third" style="padding-right: 1em">
                        <label for="correo_r">Correo</label>
                        <input class="w3-input w3-animate-input entrada" type="email" id="correo_r" data-ng-model="correo_r" required>
                    </div>
                    <div class="w3-third" style="padding-right: 1em">
                        <label for="usuario_r">Usuario</label>
                        <input class="w3-input w3-animate-input entrada" type="text" id="usuario_r" data-ng-model="usuario_r" required>
                    </div>
                    <div class="w3-third">
                        <label for="pass_r">Contraseña</label>
                        <input class="w3-input w3-animate-input entrada" type="password" id="pass_r" data-ng-model="pass_r" required>
                    </div>
                </div>
                <div class="w3-row">
                    <div class="w3-quarter" style="padding-right: 1em">
                        <label for="telefono_r">Telefono</label>
                        <input class="w3-input w3-animate-input entrada" type="tel" id="telefono_r" data-ng-model="telefono_r" required>
                    </div>
                    <div class="w3-quarter" style="padding-right: 1em">
                        <label for="sexo_r">Sexo</label>
                        <select class="w3-select entrada" name="option" id="sexo_r" data-ng-model="sexo_r" required>
                            <option value="" disabled selected>Selecciona</option>
                            <option value="M">Mujer</option>
                            <option value="H">Hombre</option>
                        </select>
                    </div>
                    <div class="w3-quarter" style="padding-right: 1em">
                        <label for="edad_r">Edad</label>
                        <input class="w3-input w3-animate-input entrada" type="number" min="1" max="100" id="edad_r" data-ng-model="edad_r" required>
                    </div>
                    <div class="w3-quarter">
                        <label for="fecha_r">Fecha de Nacimiento</label>
                        <input class="w3-input w3-animate-input entrada" type="date" id="fecha_r" data-ng-model="fecha_r" required>
                    </div>
                </div>
                <p></p>
                <input class="w3-check" type="checkbox" id="acepto_r" onchange="document.getElementById('registro').disabled=!this.checked">
                <label for="acepto_r">Acepto los <a href="#" target="_blank">términos y condiciones</a> del sistema</label>
                <div class="w3-panel w3-red w3-display-container w3-card-2" data-ng-show="error">
                    <p>Ups! :C hubo un error. Tal vez ya existe este usuario o el correo ya está en uso.</p>
                </div>
                <div class="w3-panel w3-blue w3-display-container w3-card-2" data-ng-show="correcto">
                    <p>Tu usuario ha sido creado :D, ve a tu correo para activar tu cuenta</p>
                </div>
                <p></p>
                <div align="right">
                    <button id="registro" class="w3-btn" style="background-color: #007c6e; color: white;" disabled type="submit">Registrar usuario</button><p></p>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/post_scripts.js"></script>
</body>
</html>