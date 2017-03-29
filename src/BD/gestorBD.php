<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 25/03/2017
 * Time: 09:00 AM
 */
function get_connection(){
    return new PDO('mysql:host=31.31.88.216;dbname=sfuuvgea_chilesandbeer_test;port=3306;charset=utf8mb4',
        'sfuuvgea_root', 'host_01*chiles&beer');
}
function get_connection_test(){
    return new PDO('mysql:host=localhost;dbname=diaman;charset=utf8mb4', 'root', 'root');
}
