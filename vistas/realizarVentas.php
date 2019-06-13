<?php
session_start();
 $iniciadoU=$_SESSION['usuario'];
  $idAdmin=$_SESSION['idadmin'];
    $contra=$_SESSION['contra'];
if($iniciadoU==null||$iniciadoU==''){
  header("Location:../sesion.html");
}   
$total=$_POST['total'];
$idLista=$_POST['id'];
$idadmin=$_POST['admin'];
 
    include('../bd/conexionbd.php');
    if (!$conexion) 
    {
      die('Conexión fallida a la BD: ' . mysqli_error($conexion));
    }
 $fecha=date("Y") . "-" . date("m") . "-" .date("d");
   $sql="SELECT DETALLESPEDIDOS.ClavePlatillo AS 'Clave',DETALLESPEDIDOS.cantidad AS 'Menos',PLATILLOS.Cantidad AS 'CanT',PLATILLOS.Nombre FROM DETALLESPEDIDOS,PLATILLOS WHERE  DETALLESPEDIDOS.IdListaPedido='".$idLista."' AND PLATILLOS.ClavePlatillo=DETALLESPEDIDOS.ClavePlatillo";
    $admin = mysqli_query($conexion,$sql);
 $cont=0;
while($row = mysqli_fetch_array($admin)) 
{
         $meno=(int)$row['Menos']; 
         $canT=(int)$row['CanT'];
         $clave=$row['Clave'];
    if($meno<=$canT){
         
             $cont=$cont+1;
      
    }else{
    echo '<script type="text/javascript">
    Materialize.toast("El platillo '.$row['Nombre'].' no tiene la cantidad suficiente para su venta, actualiza la cantidad de platillos porfavor, para seguir con la venta",9000,"rounded"); 
   </script>';
    }  
};

$contar="SELECT COUNT(*) AS 'Contar' FROM DETALLESPEDIDOS WHERE DETALLESPEDIDOS.IdListaPedido='".$idLista."'";
$contotal=mysqli_query($conexion,$contar);
    while($rowC = mysqli_fetch_array($contotal)) 
    {
     $contotal=$rowC['Contar'];      
    } 
if($cont==$contotal){
    
    while($row = mysqli_fetch_array($admin)) 
{
         $meno=(int)$row['Menos']; 
         $canT=(int)$row['CanT'];
         $clave=$row['Clave'];
    if($meno<=$canT){
         $reducir=($canT-$meno);
         $editar="UPDATE PLATILLOS SET Cantidad=".$reducir." WHERE ClavePlatillo='".$clave."'";
	     $query=mysqli_query($conexion,$editar);
	     if($query!=null){
            //agregar otro filtro
         }else{
             echo '<script type="text/javascript">
    Materialize.toast("No se pudo actualizar la cantidad del platillo '.$row['Nombre'].'",4000,"rounded"); 
   </script>';
         } 
    }else{
    echo '<script type="text/javascript">
    Materialize.toast("El platillo '.$row['Nombre'].' no tiene la cantidad suficiente para su venta, actualiza la cantidad de platillos porfavor",9000,"rounded"); 
   </script>';
    }  
};

       $estado="vendido";
       $editar2="UPDATE LISTADOPEDIDOS SET Estado='".$estado."' WHERE IdListaPedido='".$idLista."'";
	$query2=mysqli_query($conexion,$editar2);
if($query2!=null){
    
   
       $editar3="UPDATE ESPERA SET Estado='".$estado."' WHERE NumeroPedido='".$idLista."'";
	$query3=mysqli_query($conexion,$editar3);
if($query3!=null){
    
    $cero=0;
    $insertar="INSERT INTO VENTAS VALUES(".$cero.",".$total.",'".$fecha."',".$idadmin.",".$idLista.")";
	$isert=mysqli_query($conexion,$insertar);
    if($isert!=null){
    $contar1="SELECT COUNT(*) AS 'Contar' FROM VENTAS";
    $contotal1=mysqli_query($conexion,$contar1);
    while($rowV = mysqli_fetch_array($contotal1)) 
    {
        $conVentas=$rowV['Contar'];      
    }
        $contar2="SELECT COUNT(*) AS 'ContarV' FROM LISTADOPEDIDOS WHERE LISTADOPEDIDOS.Estado='vendido'";
    $contotal2=mysqli_query($conexion,$contar2);
    while($rowP = mysqli_fetch_array($contotal2)) 
    {
        $conVendidos=$rowP['ContarV'];      
    }
    echo '<script type="text/javascript">
    $("#totalVentas").text('.$conVentas.');
    $("#totalVendidos").text('.$conVendidos.');
    Materialize.toast("La venta se realizo exitosamente",8000,"rounded"); 
    </script>'; 
    }else{
    echo '<script type="text/javascript">
    Materialize.toast("Error no se Guardaron los datos de la Venta",8000,"rounded"); 
    </script>'; 
    }
}else{
    echo '<script type="text/javascript">
    Materialize.toast("Error no se actualizo el estado",8000,"rounded"); 
    </script>'; 
}
  }else{
    echo '<script type="text/javascript">
    Materialize.toast("Error no se actualizo el estado",8000,"rounded"); 
    </script>'; 
}
};
mysqli_close($conexion);
?>