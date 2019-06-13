<?php
include('../bd/conexionbd.php');
    if (!$conexion) 
	{
      die('Conexión fallida a la BD: ' . mysqli_error($conexion));
    }
$fecha=date("d") . "/" . date("m") . "/" . date("Y");
$cliente=$_POST['cliente'];
$contar="SELECT COUNT(*) AS 'Contar' FROM ESPERA WHERE ESPERA.Cliente='".$cliente."' AND (ESPERA.Estado='pendiente' OR ESPERA.Estado='aceptado' OR ESPERA.Estado='rechazado') AND FechaPedido='".$fecha."'";
$contotal=mysqli_query($conexion,$contar);
    while($rowC = mysqli_fetch_array($contotal)) 
    {
          $total=$rowC['Contar'];          
    } 
if($total!="0"){
    echo $total;
}else{
    echo 0;
}
    
mysqli_close($conexion);
?>