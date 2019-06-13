<?php
$error='<script type="text/javascript">
    Materialize.toast("Lo sentimos tu pedido no puede ser procesado",5000,"rounded");';

include('../bd/conexionbd.php');
    if (!$conexion) 
    {
      die('Conexión fallida a la BD: ' . mysqli_error($conexion));
    }
$DATA = json_decode($_POST['data']);
$cont=0;
for ($j=2; $j < count($DATA); $j++) {
  $clave=$DATA[$j]->idp;
$c[$j]= "SELECT PLATILLOS.Cantidad,PLATILLOS.Nombre FROM PLATILLOS WHERE PLATILLOS.ClavePlatillo='".$clave."'"; 
   $can[$j]=mysqli_query($conexion,$c[$j]);
    while($rowT = mysqli_fetch_array($can[$j])) 
    {       
     $contotal=(int)$rowT['Cantidad'];
       $menor=(int)$DATA[$j]->cantidad;
       
     if($menor<=$contotal){
        $cont=$cont+1; 
    }else{
          echo '<script type="text/javascript">
    Materialize.toast("Tu pedido no se puede realizar, ya no contamos con este platillo: '.$rowT['Nombre'].' Elige otro porfavor",8000,"rounded");
    </script>';
     }
        
}
};
$numero=(int)$DATA[1]->ntotal;
if($numero==$cont){
    $sql="'".$DATA[0]->colonia."','".$DATA[0]->calles."','".$DATA[0]->numcasa."','".$DATA[0]->referencia."','".$DATA[0]->ubicacion."'";
$cero=0;
$insertar="INSERT INTO ".$DATA[0]->tabla." VALUES(".$cero.",".$sql.")";
$query=mysqli_query($conexion,$insertar);
	if($query!=null){ 
    $consulta="SELECT MAX(ClaveUbicacion) AS 'ULTIMO' FROM UBICACION ORDER BY ClaveUbicacion";
$query1=mysqli_query($conexion,$consulta);
while($row = mysqli_fetch_array($query1)) 
    {
          $idubi=$row['ULTIMO'];          
    } 
      $fecha=date("d") . "/" . date("m") . "/" . date("Y");
    
        $hora=date("h").":".date("i").":".date("s")." ".date("A"); 
        $estado="pendiente";
        $idcliente=$DATA[0]->cliente;
$sql2="'".$fecha."','".$hora."','".$estado."',".$DATA[0]->pretotal.",".$idubi.",".$idcliente."";


$cero2=0;
$insertar2="INSERT INTO LISTADOPEDIDOS VALUES(".$cero2.",".$sql2.")";
$query2=mysqli_query($conexion,$insertar2);
if($query2!=null){
    
     $consulta2="SELECT MAX(IdListaPedido) AS 'idultimo' FROM LISTADOPEDIDOS ORDER BY IdListaPedido";
$query3=mysqli_query($conexion,$consulta2);
while($row2 = mysqli_fetch_array($query3)) 
    {
      $idlista=$row2['idultimo'];          
    } 
  $c=0;
 $insertar4="INSERT INTO PENDIENTE VALUES(".$idlista.",'".$fecha."',".$c.")";
$query4=mysqli_query($conexion,$insertar4);
if($query4!=null) {
 $mensage="Tu pedido esta ciendo prosezado";
 $estado="pendiente";
$insertar5="INSERT INTO ESPERA VALUES(".$idlista.",'".$fecha."',".$idcliente.",'".$estado."','".$mensage."')";
$query5=mysqli_query($conexion,$insertar5);
if($query5!=null) {
    
$contar="SELECT COUNT(*) AS 'Contar' FROM ESPERA WHERE ESPERA.Cliente='".$idcliente."' AND (ESPERA.Estado='pendiente' OR ESPERA.Estado='aceptado' OR ESPERA.Estado='rechazado') AND FechaPedido='".$fecha."'";
$contotal=mysqli_query($conexion,$contar);
    while($rowC = mysqli_fetch_array($contotal)) 
    {
          $total=$rowC['Contar'];          
    } 
    echo '<script type="text/javascript">
    $("#pedidosR").text('.$total.');
    </script>';
for ($i=2; $i < count($DATA); $i++) {
$q[$i]= "INSERT INTO DETALLESPEDIDOS VALUES(".$idlista.",'".$DATA[$i]->idp."',".$DATA[$i]->arroz.",".$DATA[$i]->pasta.",".$DATA[$i]->salsa.",".$DATA[$i]->preuni.",".$DATA[$i]->cantidad.",".$DATA[$i]->subtotal.")"; 
    $insertartabla=mysqli_query($conexion,$q[$i]);
}
if($insertartabla!=null){
    echo '<script type="text/javascript">
    Materialize.toast("Tu pedido se envio exitosamente, Tu número de pedido es: '.$idlista.'",5000,"rounded");
    $("#numeroLista").text('.$idlista.');
    </script>';
}else{
   echo $error;
}  
}else{
    echo $error;
}
    
}else{
     echo $error;
} 
}else{
     echo $error;
}     
}else{
    echo $error;
    }    
}else{
    
    echo '<script type="text/javascript">
    Materialize.toast("No se pudo realizar tu pedido",8000,"rounded");
    </script>';
}

?>