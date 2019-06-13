  <?php
 session_start();
 $iniciadoU=$_SESSION['usuario'];
  $idAdmin=$_SESSION['idadmin'];
    $contra=$_SESSION['contra'];
if($iniciadoU==null||$iniciadoU==''){
  header("Location:../sesion.html");
}   
    include('../bd/conexionbd.php');
    if (!$conexion) 
    {
      die('Conexión fallida a la BD: ' . mysqli_error($conexion));
    }
   $contar1="SELECT COUNT(*) AS 'Contar' FROM VENTAS";
    $contotal1=mysqli_query($conexion,$contar1);
    while($rowV = mysqli_fetch_array($contotal1)) 
    {
        $conVentas=$rowV['Contar'];      
    }
if($conVentas!="0"){
    echo $conVentas;
}else{
    echo 0;
}
mysqli_close($conexion);
?>