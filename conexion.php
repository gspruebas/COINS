<?php
use LDAP\Connection;

$host = 'sql213.epizy.com';
$user = 'epiz_33206363';
$password = 'GUs55843244';
$db = 'epiz_33206363_facturacion';


$conection = @mysqli_connect($host, $user, $password, $db);


//


if(!$conection){
    echo "Error en la Conexion";

}


?>