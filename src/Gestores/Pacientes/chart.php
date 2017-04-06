<?php

// This is just an example of reading server side data and sending it to the client.
// It reads a json formatted text file and outputs it.
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();
require('../../BD/gestorBD.php');
$conexion = get_connection_test();
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$paciente = $_SESSION['paciente'];
$sql = "SELECT * FROM diagnostico WHERE diagnostico.no_paciente = '$paciente'";
$string = '{
  "cols": [
    {"id":"","label":"DX","pattern":"","type":"string"},
    {"id":"","label":"Glucosa","pattern":"","type":"number"},
    {"id":"","label":"IMC","pattern":"","type":"number"}
  ],
  "rows": [';
try{
    $result=$conexion->query($sql);
    $out = "";
    $i=1;
    while($rs = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($out != "") {$out .= ",";}
        $out .='{"c":[{"v":"DX'.$i.'","f":null},{"v":'.$rs["niv_glucosa"].',"f":null},{"v":'.$rs["imc"].',"f":null}]}';
        $i++;
    }
    $conexion = null;


    $string.=$out.']}';
    echo $string;
}catch(PDOException $e){
    echo '{"error":{"error":'. $e->getMessage() .'}}';
}
/*
$string.='
    {"c":[{"v":"Mushrooms","f":null},{"v":3,"f":null},{"v":7,"f":null}]},
    {"c":[{"v":"Onions","f":null},{"v":1,"f":null},{"v":6,"f":null}]},
    {"c":[{"v":"Olives","f":null},{"v":1,"f":null},{"v":5,"f":null}]},
    {"c":[{"v":"Zucchini","f":null},{"v":1,"f":null},{"v":6,"f":null}]},
    {"c":[{"v":"Pepperoni","f":null},{"v":2,"f":null},{"v":3,"f":null}]}';
*/
// Instead you can query your database and parse into JSON etc etc

?>