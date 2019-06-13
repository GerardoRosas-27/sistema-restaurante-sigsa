  
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
$fecha=date("d") . "/" . date("m") . "/" . date("Y");
  $contar2="SELECT COUNT(*) AS 'ContarV' FROM LISTADOPEDIDOS WHERE LISTADOPEDIDOS.Estado='vendido' AND LISTADOPEDIDOS.FechaPedido='".$fecha."'";
    $contotal2=mysqli_query($conexion,$contar2);
    while($rowP = mysqli_fetch_array($contotal2)) 
    {
        $conVendidos=$rowP['ContarV'];      
    }
if($conVendidos!="0"){
    echo $conVendidos;
}else{
    echo 0;
}
mysqli_close($conexion);
?>
  
  
 




  