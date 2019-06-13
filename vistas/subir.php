<?php
session_start();
 $iniciadoU=$_SESSION['usuario'];
  $idAdmin=$_SESSION['idadmin'];
    $contra=$_SESSION['contra'];
if($iniciadoU==null||$iniciadoU==''){
  header("Location:../sesion.html");
}   
/*
$local = $_FILES["archivo"]["name"];
$remoto = $_FILES["archivo"]["tmp_name"];
$ruta = "/httpdocs/" . $local;
is_uploaded_file($remoto);
[b]copy($remoto, $ruta);[/b]
ftp_close($cid);

*/

$temporal=$_FILES['files']['tmp_name'];
$nombre=$_FILES['files']['name'];
$destinoArchivo=$_SERVER['DOCUMENT_ROOT'].'../SistemaAdministracionSigsa_v3.9/assets/img/'.$nombre;

move_uploaded_file($temporal,$destinoArchivo);
	if($_FILES['files']['error']==''){	
		include('../bd/conexionbd.php');
    if (!$conexion) 
    {
      die('Conexión fallida a la BD: ' . mysqli_error($conexion));
    }
$cero=0;
$insertar="INSERT INTO IMAGENES VALUES(".$cero.",'".$nombre."')";
	$query=mysqli_query($conexion,$insertar);
	if($query!=null){
		echo '<script type="text/javascript">
    Materialize.toast("El archivo:'.$nombre.' se guardo correctamente",4000,"rounded"); 
   </script>';
	}else{
		echo '<script type="text/javascript">
		      Materialize.toast("El dato no se pudo guardar",4000,"rounded");
             </script>';
	};
    mysqli_close($conexion);
	}else{
	if($_FILES['files']['error']!=''){	
	echo '<script type="text/javascript">
	 Materialize.toast("El archivo: '.$nombre.' no se pudo subir, error: '.$_FILES['files']['error'].'" ,4000,"rounded"); 
   </script>';
	}
	}
?>