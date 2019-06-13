<?php
$ser= 'localhost';
$userna= 'root';
$pass='';
$database= 'SIGSA';

$conexion = mysqli_connect($ser,$userna,$pass,$database);
mysqli_set_charset($conexion,'utf8');
date_default_timezone_set('America/Mexico_City');
if( $conexion->connect_error )
{
	die('Error de conexion'. $conexion->connect_error);
}
?>