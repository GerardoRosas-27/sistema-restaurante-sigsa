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
   $sql="SELECT IdListaPedido,FechaPedido,HoraPedido,Estado,Total,LISTADOPEDIDOS.Ubicacion,LISTADOPEDIDOS.IdCliente,CLIENTESREGISTRADOS.NombreCompleto,CLIENTESREGISTRADOS.Telefono,UBICACION.Colonia,UBICACION.Calle,UBICACION.NumCasa,UBICACION.Referencias,UBICACION.CordenadaLatitudLongitud FROM LISTADOPEDIDOS,CLIENTESREGISTRADOS,UBICACION WHERE Estado='vendido' AND LISTADOPEDIDOS.FechaPedido='".$fecha."' AND LISTADOPEDIDOS.IdCliente=CLIENTESREGISTRADOS.IdCliente AND
   LISTADOPEDIDOS.Ubicacion=UBICACION.ClaveUbicacion ORDER BY IdListaPedido" ;
    $admin = mysqli_query($conexion,$sql);


echo '<div class="container" style="margin-bottom: 128px;">

 <div class="row">';
  while($row = mysqli_fetch_array($admin)) 
     {
    $sql2="SELECT DISTINCT DETALLESPEDIDOS.IdListaPedido,PLATILLOS.Nombre,Arroz,Pasta,Salsa,PrecioUnitario,DETALLESPEDIDOS.Cantidad,PrecioSubtotal 
FROM DETALLESPEDIDOS,PLATILLOS,LISTADOPEDIDOS WHERE PLATILLOS.ClavePlatillo=DETALLESPEDIDOS.ClavePlatillo 
AND DETALLESPEDIDOS.IdListaPedido='".$row['IdListaPedido']."'";
    $admin2= mysqli_query($conexion,$sql2);

 echo'
     <ul class="tabs tabs-fixed-width">
    <li class="tab col s3"><a class="active" href="#test-swipe-n'.$row['IdListaPedido'].'">Pedido: '.$row['IdListaPedido'].'</a></li>
    <li class="tab col s3"><a href="#test-swipe-1'.$row['IdListaPedido'].'">Cliente</a></li>
    <li class="tab col s3"><a href="#test-swipe-2'.$row['IdListaPedido'].'">Platillos</a></li>
    <li class="tab col s3"><a href="#test-swipe-3'.$row['IdListaPedido'].'">Vendidos</a></li>
  </ul>
   <div id="test-swipe-n'.$row['IdListaPedido'].'" class="col s12 grey lighten-5">
 
  </div>
  <div id="test-swipe-1'.$row['IdListaPedido'].'" class="col s12 grey lighten-5">
 
 
 <table class="responsive-table">
  <tr>
  <td>
    <p>Id Cliente: '.$row['IdCliente'].'</p>
    <p>Nombre: '.$row['NombreCompleto'].'</p>
    <p>Telefono: '.$row['Telefono'].'</p>
  </td>
  <td>
    <p>Colonia: '.$row['Colonia'].'</p>
    <p>Calles: '.$row['Calle'].'</p>
    <p>Numero de Casa: '.$row['NumCasa'].'</p>
    <p>Referencias: '.$row['Referencias'].'</p>
  </td>
    <td>
    
     <button id="botonMapa" data-ubi="'.$row['CordenadaLatitudLongitud'].'" type="submit" class="modal-action waves-effect waves-light btn">Ubicación</button>
     </td>
   </tr> 
 </table>

  </div>

  <div id="test-swipe-2'.$row['IdListaPedido'].'" class="col s12 grey lighten-5">
     
  <table class="responsive-table">
				<thead>
					<tr>
						
						<th data-field="name">Nobre del Platillo</th>
						<th data-field="name">Precio del Platillo</th>
						<th data-field="name">Cantidad de Platillos</th>
						<th data-field="name">Arroz</th>
						<th data-field="option">Pasta</th>
                        <th data-field="option">Salsas</th>
                        <th data-field="option">Precio Subtotal</th>
					</tr>
				</thead>
				<tbody>';
		        
   while($row2= mysqli_fetch_array($admin2)) 
   {
        echo'<tr>';	
        //echo'<td>'.$row2['IdListaPedido'].'</td>';
        echo'<td>'.$row2['Nombre'].'</td>';
        echo'<td>'.$row2['PrecioUnitario'].'</td>';
        echo'<td>'.$row2['Cantidad'].'</td>';
        echo'<td>'.$row2['Arroz'].'</td>';
        echo'<td>'.$row2['Pasta'].'</td>';
        echo'<td>'.$row2['Salsa'].'</td>';
        echo'<td>'.$row2['PrecioSubtotal'].'</td>';		
        echo "</tr>";
  }
        echo '</tbody>
</table>       
 
  </div>
<div id="test-swipe-3'.$row['IdListaPedido'].'" class="col s12 grey   lighten-5">
  <table class="responsive-table">
  <tr>
  <td>
  	<p>Id Lista: '.$row['IdListaPedido'].'</p>
    <p>Hora del Pedido: '.$row['HoraPedido'].'</p>
    <p>Fecha del Pedido: '.$row['FechaPedido'].'</p>
    <p>Precio Total: '.$row['Total'].'</p>
  </td>';

$numeropedido=$row['IdListaPedido'];
   
 $sql3="SELECT DISTINCT VENTAS.IdVenta,VENTAS.Total AS 'TotalV',VENTAS.FechaVenta,ADMINISTRADORES.Nombre AS 'NombreAdmin' FROM LISTADOPEDIDOS,VENTAS,ADMINISTRADORES WHERE 
 VENTAS.IdListaPedido='".$numeropedido."' AND ADMINISTRADORES.IdAdmin=VENTAS.IdAdmin"; 
    $ventas = mysqli_query($conexion,$sql3);     
         
   while($row3= mysqli_fetch_array($ventas)) 
   {
    echo'<td>
    <p>Número de venta: '.$row3['IdVenta'].'</p>
    <p>Precio total: '.$row3['TotalV'].'</p>
    <p>Fecha de la venta: '.$row3['FechaVenta'].'</p>
    <p>Nombre del administrador: '.$row3['NombreAdmin'].'</p>
  </td>';
   }
    echo'</tr>
     </table>
  </div>';
     }
  echo'</div>
</div>

<script src="./js/controladorAjax.js"></script>
';

	mysqli_close($conexion);
?>