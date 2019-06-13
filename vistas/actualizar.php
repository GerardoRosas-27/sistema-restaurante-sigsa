<?php
session_start();
 $iniciadoU=$_SESSION['usuario'];
  $idAdmin=$_SESSION['idadmin'];
    $contra=$_SESSION['contra'];
if($iniciadoU==null||$iniciadoU==''){
  header("Location:../sesion.html");
}   

   $tabla=$_POST['tabla'];
   include('../bd/conexionbd.php');
    if (!$conexion) 
    {
      die('Conexión fallida a la BD: ' . mysqli_error($conexion));
    }
 $fecha=date("d") . "/" . date("m") . "/" . date("Y");

$consulta="SELECT NumPedido,FechaP,Leeido FROM PENDIENTE WHERE FechaP='".$fecha."'";

$sql=mysqli_query($conexion,$consulta);
$cont=0;
while($row = mysqli_fetch_array($sql)) 
{ 
    $num1 = (int)$row['NumPedido']; 
    $num2 = (int)$row['Leeido']; 
    if($num1!=$num2){
      $cont=$cont+1; 
         
        
    $editar="UPDATE PENDIENTE SET Leeido=".$num1." WHERE NumPedido=".$num1."";
	$query=mysqli_query($conexion,$editar);
	if($query!=null){
    }
}
}

if($cont>0){
  echo $cont;
}else{
    echo 0;
}
mysqli_close($conexion);
?>