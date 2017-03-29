<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require('../../src/BD/gestorBD.php');
$conexion = get_connection_test();
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$result=$conexion->query('SELECT * FROM medicamento');
$salida = "";
while($rs = $result->fetch(PDO::FETCH_ASSOC)) {
    if ($salida != "") {$salida .= ",";}
    $salida .= '{"Nombre":"'    .$rs["nombre"]               .'",';
    $salida .= '"Descripcion":"'.$rs["descripcion"]          .'",';
    $salida .= '"Dosis":"'      .$rs["dosis"]                .'",';
    $salida .= '"Via":"'        .$rs["via_administracion"]   .'"}';
}
$salida ='{"registro":['.$salida.']}';
$conexion = null;
echo($salida);
/*
require('../../src/BD/gestorBD.php');
$conn = get_connection_test();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Connected successfully";
$rows=$conn->query('SELECT * FROM usuario');
echo '<table>';
foreach ($rows as $row){
    echo '<tr>';
    echo '<td>'.$row['nombre']."</td><td>".$row['apellido']."</td><td>".$row['edad']."</td><td>".$row['correo']."</td>";
    echo '</tr>';
}
echo '</table>';*/
?>