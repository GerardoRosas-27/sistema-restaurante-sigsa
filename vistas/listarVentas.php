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

$validar=$_POST['validar'];
if($validar=="filtrar"){
    $inicio=$_POST['fechain'];
    $fin=$_POST['fechafi'];
    
    $sql3="SELECT VENTAS.IdVenta,VENTAS.Total AS 'TotalV',VENTAS.FechaVenta,ADMINISTRADORES.Nombre AS 'NombreAdmin',LISTADOPEDIDOS.IdListaPedido AS 'listaP' FROM LISTADOPEDIDOS,VENTAS,ADMINISTRADORES WHERE 
 VENTAS.IdListaPedido=LISTADOPEDIDOS.IdListaPedido AND ADMINISTRADORES.IdAdmin=VENTAS.IdAdmin AND (VENTAS.FechaVenta BETWEEN '".$inicio."' AND '".$fin."') ORDER BY VENTAS.IdVenta"; 
    $ventas = mysqli_query($conexion,$sql3);

}else{
    $fecha=date("Y") . "-" . date("m") . "-" .date("d");
    $sql3="SELECT VENTAS.IdVenta,VENTAS.Total AS 'TotalV',VENTAS.FechaVenta,ADMINISTRADORES.Nombre AS 'NombreAdmin',LISTADOPEDIDOS.IdListaPedido AS 'listaP' FROM LISTADOPEDIDOS,VENTAS,ADMINISTRADORES WHERE 
 VENTAS.IdListaPedido=LISTADOPEDIDOS.IdListaPedido AND ADMINISTRADORES.IdAdmin=VENTAS.IdAdmin AND VENTAS.FechaVenta='".$fecha."'  ORDER BY VENTAS.IdVenta"; 
    $ventas = mysqli_query($conexion,$sql3);
    
}
  
echo'<div class="container" style="margin-bottom: 128px;">		
 <div class="row">
 <h5 class="center-align">VENTAS</h5>
 <h5 class="center-align">Ingreso Total: $<span id="IngresoTotal">0</span>.00 Mx</h5>
  
		
<div class="col s12">
<button class="waves-effect waves-light blue btn" id="btnCalcular">Calcular</button>
<table id="tablaV" class="responsive-table">
    <thead>
        <tr>
            <th>CLAVE VENTA</th>
            <th>TOTAL</th>
			 <th>FECHA VENTA</th>
             <th>ADMINISTRADOR</th>
            <th>LISTA PEDIDO</th>
			
        </tr>
    </thead>
    <tbody>';
	        
   while($row3= mysqli_fetch_array($ventas)) 
   {
      echo'<tr>
            <td>'.$row3['IdVenta'].'</td>
            <td  class="sumar">'.$row3['TotalV'].'</td>
             <td>'.$row3['FechaVenta'].'</td>
               <td>'.$row3['NombreAdmin'].'</td>
               <td>'.$row3['listaP'].'</td>
			  <td></td>
			  
        </tr>';
       }
  echo'</tbody>
</table>
</div>
</div>
</div>
<script src="./js/controladorAjax.js"></script>';

	mysqli_close($conexion);
?>