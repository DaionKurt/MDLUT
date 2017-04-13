<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 11/04/2017
 * Time: 10:27 AM
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require('src/BD/gestorBD.php');
$conexion   = get_connection_test();

$id = $_GET['id'];
$clave = $_GET['code'];
$correo = $_GET['email'];
$usuario = $_GET['user'];

$verificacion = $conexion->prepare("SELECT usuario FROM usuario_pendiente 
                WHERE id_usuario=:id AND correo=:correo AND clave=:clave");
$verificacion->bindParam(':id'      ,$id    ,PDO::PARAM_INT);
$verificacion->bindParam(':correo'  ,$correo,PDO::PARAM_STR);
$verificacion->bindParam(':clave'   ,$clave ,PDO::PARAM_STR);
$verificacion->execute();
if($verificacion->rowCount()==1) {
    $sentencia = $conexion->prepare("INSERT INTO paciente(no_usuario,estado_diabetico) VALUES(:id,'No Diabético')");
    $sentencia->bindParam(':id',$id,PDO::PARAM_INT);
    $sentencia->execute();
    $eliminar = $conexion->prepare("DELETE FROM usuario_pendiente WHERE id_usuario=:id AND correo=:correo AND clave=:clave");
    $eliminar->bindParam(':id'      ,$id    ,PDO::PARAM_INT);
    $eliminar->bindParam(':correo'  ,$correo,PDO::PARAM_STR);
    $eliminar->bindParam(':clave'   ,$clave ,PDO::PARAM_STR);
    $eliminar->execute();
    $actualizar = $conexion->prepare("UPDATE usuario SET activo=1 WHERE id_usuario=:id");
    $actualizar->bindParam(':id',$id,PDO::PARAM_INT);
    $actualizar->execute();
    ?>
        Cuenta activada
<?php
}else{
    ?>
    Esta cuenta ya se activó previamente
<?php
}
?>
