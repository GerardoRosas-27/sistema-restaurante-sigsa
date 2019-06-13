<?php 
include('../bd/conexionbd.php');
    if (!$conexion) 
	{
      die('Conexión fallida a la BD: ' . mysqli_error($conexion));
    }
$fecha=date("d") . "/" . date("m") . "/" . date("Y");
$cliente=$_POST['cliente'];
$lista="SELECT ESPERA.NumeroPedido,ESPERA.FechaPedido,ESPERA.Cliente,ESPERA.Estado,ESPERA.Mensage FROM ESPERA WHERE FechaPedido='".$fecha."'";
$cargar=mysqli_query($conexion,$lista);
echo'<ul class="collapsible" data-collapsible="accordion">';
    while($rowE = mysqli_fetch_array($cargar)) 
    {
        $lista2="SELECT CLIENTESREGISTRADOS.IdCliente,CLIENTESREGISTRADOS.Usuario FROM CLIENTESREGISTRADOS WHERE CLIENTESREGISTRADOS.IdCliente='".$cliente."'";
$cargar2=mysqli_query($conexion,$lista2);

    while($rowC = mysqli_fetch_array($cargar2)) 
    {
        $idclienteR=$rowC['IdCliente'];
        $usuario=$rowC['Usuario']; 
    }
     $mensage=$rowE['Mensage']; 
     $estado=$rowE['Estado']; 
      $num=$rowE['NumeroPedido'];
        $clienteE=(int)$rowE['Cliente'];
        if($idclienteR==$clienteE){
            $usuario=$usuario;
        }else{
            $usuario="";
        }
     if($estado=="pendiente"){
    echo'
    <li>
    <div class="collapsible-header">'.$usuario.'<br>'.$num.': Tu pedido está siendo procesado, espere un momento porfavor.
     <span class="new badge blue" data-badge-caption="En Espera"></span>
    </div>
  </li>';  
        }else{
         if($estado=="aceptado"){
        echo'     
    <li>
    <div class="collapsible-header">'.$usuario.'<br>'.$num.': Tu pedido fue aceptado
     <span class="new badge" data-badge-caption="Aceptado"></span>
    </div>
  </li>';             
        }else{
             if($estado=="rechazado"){
                 echo'<li>
    <div class="collapsible-header">'.$usuario.'<br>'.$num.': Tu pedido fue rechazado
     <span class="new badge red" data-badge-caption="Rechazado"></span>
    </div>
  </li>';     
             }
         }
     }       
    } 
echo'</ul>';
mysqli_close($conexion);
?>