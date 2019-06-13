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
$id=$_POST['id'];
$estado=$_POST['estado'];
//$mensage=$_POST['msg'];

$editar="UPDATE ESPERA SET Estado='".$estado."' WHERE NumeroPedido='".$id."'";
	$query=mysqli_query($conexion,$editar);
	if($query!=null){
        if($estado=="aceptado"){
            $editar2="UPDATE LISTADOPEDIDOS SET Estado='".$estado."' WHERE IdListaPedido='".$id."'";
	$query2=mysqli_query($conexion,$editar2);
	if($query2!=null){
        echo '<script type="text/javascript">
    Materialize.toast("El pedido fue: '.$estado.'",5000,"rounded");
    </script>'; 
    }else{
       echo '<script type="text/javascript">
    Materialize.toast("Error no se pudo aceptar el pedido",5000,"rounded");
    </script>';  
    }   
    }else{
    $editar3="UPDATE LISTADOPEDIDOS SET Estado='".$estado."' WHERE IdListaPedido='".$id."'";
	$query3=mysqli_query($conexion,$editar3);
	if($query3!=null){
       echo '<script type="text/javascript">
    Materialize.toast("El pedido fue: '.$estado.'",5000,"rounded");
    </script>';
    }else{
    echo '<script type="text/javascript">
    Materialize.toast("Error no se pudo rechazar el pedido",5000,"rounded");
    </script>';  
    }
        }    
    }else{
    echo '<script type="text/javascript">
    Materialize.toast("Error no se pudo realizar la operacion",5000,"rounded");
    </script>';
    }
mysqli_close($conexion);
?>