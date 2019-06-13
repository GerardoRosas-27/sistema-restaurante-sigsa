<?php
session_start();
 $iniciadoU=$_SESSION['usuario'];
  $idAdmin=$_SESSION['idadmin'];
    $contra=$_SESSION['contra'];
if($iniciadoU==null||$iniciadoU==''){
  header("Location:../sesion.html");
}   
   $tabla=$_POST['tabla'];

switch ($tabla) 
    {
    case 'PLATILLOS':
     $sql="'".$_POST['clave']."','".$_POST['nombre']."',".$_POST['cantidad'].",".$_POST['precio'].",".$_POST['idimg'].",".$_POST['idmenu']."";
       insertar($tabla,$sql);
        break;
    case 'MENU':
       $sql="'".$_POST['dia']."','".$_POST['pro']."','".$_POST['ha']."','".$_POST['hc']."'";
       insertar($tabla,$sql);
        break;
    case 'UBICACION':
 $sql="'".$_POST['colonia']."','".$_POST['calles']."','".$_POST['numcasa']."','".$_POST['referencia']."','".$_POST['ubicacion']."'";
       insertar($tabla,$sql);
        break;
    case 'ADMINISTRADORES':
 $sql="'".$_POST['nombreadmin']."','".$_POST['contraadmin']."'";
       insertar($tabla,$sql);
        break;
    default:
        echo "esta regla es por defecto";
    };

function insertar($tabla,$sql){
	
    include('../bd/conexionbd.php');
    if (!$conexion) 
    {
      die('Conexión fallida a la BD: ' . mysqli_error($conexion));
    }
$cero=0;
$insertar="INSERT INTO ".$tabla." VALUES(".$cero.",".$sql.")";
	$query=mysqli_query($conexion,$insertar);
	if($query!=null){
		echo '<script>
   Materialize.toast("Los datos se guardaron correctamente",4000,"rounded");
   </script>';
	}else{
		echo '<script type="text/javascript">
    Materialize.toast("Error, los datos no se guardaron",4000,"rounded");
   </script>';
	};
    mysqli_close($conexion);
	}
  ?>