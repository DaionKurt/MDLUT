<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 11/04/2017
 * Time: 10:27 AM
 */
/*
$fname = "Carlos";
$id = 1;
$clave = (bin2hex(random_bytes(20)));
$message = '<p>Hi ' . $fname . ',<br/><br/>welcome!</p><p><a href="http://www.home.com/en/verification.php?id=' . $id . '&code=' . $clave . '">Please click this link</a> to activate your account.</p><p>We hope you enjoy our page and are happy to hear about your experiences!</p><p>Your team</p>';


$header  = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
$header .= "From: Sender <carlosfdez@outlook.com>";
$header .= "X-Mailer: PHP ". phpversion();
mail('carlosfdez@outlook.com', 'Thank you for registering!', $message, $header);*/

$fname = "Carlos";
$id = 1;
$clave = (bin2hex(random_bytes(20)));

// Multiple recipients
$to = 'carlosfdez@outlook.com'; // note the comma

// Subject
$subject = 'Birthday Reminders for August';

$string =  "Verify.php?id=".$id."&code=".$clave;

// Message
$message = '
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        .link{color: green;}
    </style>
</head>
<body>
  <p>Hola '.$nombre.' '.$apellido.',<br>Bienvenido!<br></p>
  <p>Nos da mucho gusto que formes parte de nuestro sistema: Diaman, esperamos te sea de mucha utilidad.</p>
  <p>Para finalizar el proceso de creación de tu cuenta, te pedimos des click en el siguiente link:</p>
  <a class="link" href="http://localhost:63342/Proyecto%20Modular/verification.php?id=' . $id . '&code=' . $clave . '">
    Enlace de activación</a> 
  <p>Esto activará tu cuenta y podrás hacer uso del sistema</p>
  <p>Esperamos disfrutes del sitio y nos gustaría escuchar tus experiencias</p>
  <hr><p>Diaman <br> Diabetes Manager and Analyer</p>
</body>
</html>';


// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=UTF-8';

// Additional headers
$headers[] = 'To: Mary <carlosfdez@outlook.com>';
$headers[] = 'From: Birthday Reminder <carlosfdez@outlook.com>';
$headers[] = 'Cc: carlosfdez@outlook.com';
$headers[] = 'Bcc: carlosfdez@outlook.com';

// Mail it
mail($to, $subject, $message, implode("\r\n", $headers));
/*
$id = 1;
$clave = (bin2hex(random_bytes(20)));
$to      = 'carlosfdez@outlook.com';
$subject = 'Prueba';
$headers = "From: " . strip_tags('carlosfdez@outlook.com') . "\r\n";
$headers .= "Reply-To: ". strip_tags('carlosfdez@outlook.com') . "\r\n";
$headers .= "CC: susan@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = '
<html>
<head>
  <title>Birthday Reminders for August</title>
</head>
<body>
  <p>Here are the birthdays upcoming in August!</p>
  Por favor da click en este enlace <a href="Verify.php?id='.$id.'&code='.$clave.'">AQUI</a> para activar tu cuenta.
</body>
</html>';

echo (bin2hex(random_bytes(20)));

mail($to, $subject, $message, $headers);
*/
/*
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "../../BD/gestorBD.php";
$conexion = get_connection_test();

$paciente_IDX = 1;

$sentencia = $conexion->prepare("
           SELECT * FROM Diagnostico 
INNER JOIN Paciente WHERE Diagnostico.no_paciente = :paciente AND Paciente.id_paciente = :paciente_s");
$sentencia->bindParam(':paciente',$paciente_IDX,PDO::PARAM_INT);
$sentencia->bindParam(':paciente_s',$paciente_IDX,PDO::PARAM_INT);

try{
    $sentencia->execute();
    $salida = "";
    while($rs = $sentencia->fetch(PDO::FETCH_ASSOC)) {
        if ($salida != "") {$salida .= ",";}
        $salida .= '{"Estado":"' .$rs["estado"]   .'",';
        $salida .= '"IMC":"'     .$rs["imc"] .'",';
        $salida .= '"Glucosa":"' .$rs["niv_glucosa"]     .'",';
        $salida .= '"Cat_g":"'   .$rs["cat_glucosa"]     .'",';
        $salida .= '"Certeza":"' .$rs["porc_certeza"]     .'"}';
    }
    $salida ='{"diagnosticos":['.$salida.']}';
    echo $salida;
}catch(PDOException $e){
    return '{"error":{"error":'. $e->getMessage() .'}}';
}
*/
/*
$medico_IDX = 1;
$sentencia = $conexion->prepare("
              SELECT * FROM usuario INNER JOIN medico ON usuario.id_usuario=medico.no_usuario AND usuario.id_usuario=:medico");
$sentencia->bindParam(':medico',$medico_IDX,PDO::PARAM_INT);
try{
    $sentencia->execute();
    $salida = "";
    while($rs = $sentencia->fetch(PDO::FETCH_ASSOC)) {
        if ($salida != "") {$salida .= ",";}
        $salida .= '{"Nombre":"'    .$rs["nombre"]          .'",';
        $salida .= '"Apellido":"'   .$rs["apellido"]        .'",';
        $salida .= '"Sexo":"'       .$rs["sexo"]            .'",';
        $salida .= '"Fecha":"'      .$rs["fecha_nacimiento"].'",';
        $salida .= '"Telefono":"'   .$rs["telefono"]        .'",';
        $salida .= '"Edad":"'       .$rs["edad"]            .'",';
        $salida .= '"Usuario":"'    .$rs["usuario"]         .'",';
        $salida .= '"Correo":"'     .$rs["correo"]          .'",';
        $salida .= '"Cedula":"'     .$rs["no_cedula"]       .'",';
        $salida .= '"Grado":"'      .$rs["grado"]           .'",';
        $salida .= '"Especialidad":"'.$rs["especialidad"]   .'",';
        $salida .= '"Universidad":"'.$rs["universidad"]     .'"}';
    }
    return $salida;
}catch(PDOException $e) {
    return '{"error":{"error":' . $e->getMessage() . '}}';
}
*/
/*
$medico_n = "1; DROP DATABASE Diaman;";
$sentencia=$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$sentencia=$conexion->prepare("SELECT * FROM horario WHERE medico = :medico");
$sentencia->bindParam(':medico', $medico_n, PDO::PARAM_STR);
#$sentencia->execute();
#print_r($sentencia->fetch(PDO::FETCH_ASSOC));

try{
    $sentencia->execute();
    $salida = "";
    while($rs = $sentencia->fetch(PDO::FETCH_ASSOC)) {
        if ($salida != "") {$salida .= ",";}
        $salida .= '{"Dia":"'.$rs["dia"] .'",';
        $salida .= '"Hora":"'        .$rs["hora"]     .'",';
        $salida .= '"Libre":"'       .$rs["libre"]     .'"}';
    }
    $salida ='{"horarios":['.$salida.']}';
    echo $salida;
}catch(PDOException $e){
    return '{"error":{"error":'. $e->getMessage() .'}}';
}*/