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
    case 'IMAGENES':
		actualizarimg();
		$campo=$_POST['nombreimg'];
		$sql="Nombre='".$campo."' WHERE ClaveImg=".$_POST['id']."";
        actualizar($tabla,$sql);
        break;
    case 'PLATILLOS':
        $sql="ClavePlatillo='".$_POST['clave']."',  Nombre='".$_POST['nombre']."', 
		Cantidad=".$_POST['cantidad'].",
		Precio=".$_POST['precio'].", 
		Imagen=".$_POST['idimg'].",
        IdMenu=".$_POST['idmenu']." WHERE IdPlatillo=".$_POST['id']."";
        actualizar($tabla,$sql);
        break;
    case 'MENU':
         $sql="Dia='".$_POST['dia']."', 
		Promociones='".$_POST['pro']."',
        HorarioApertura='".$_POST['ha']."', 
		HorarioCierre='".$_POST['hc']."' WHERE IdMenu=".$_POST['id']."";
        actualizar($tabla,$sql);
        break;
    case 'ADMINISTRADORES':
         $sql="Nombre='".$_POST['nombreadmin']."',
        Contrasena='".$_POST['contraadmin']."' WHERE IdAdmin=".$_POST['idadmin']."";
        actualizar($tabla,$sql);
        break;
    default:
        echo "No se ingreso una tabla";
    };
function actualizarimg(){
@unlink('../assets/img/'.$_POST['eliminar']);
$temporal=$_FILES['archivo']['tmp_name'];
$nombre=$_FILES['archivo']['name'];
$destinoArchivo=$_SERVER['DOCUMENT_ROOT'].'../SistemaAdministracionSigsa_v3.9/assets/img/'.$nombre;
move_uploaded_file($temporal,$destinoArchivo);
}
function actualizar($tabla,$sql){
    include('../bd/conexionbd.php');
    if (!$conexion) 
    {
      die('Conexión fallida a la BD: ' . mysqli_error($conexion));
    }
$editar="UPDATE ".$tabla." SET ".$sql;
	$query=mysqli_query($conexion,$editar);
	if($query!=null){
		echo '<script>
		 Materialize.toast("Los datos se actualizaron correctamente",4000,"rounded");
        </script>';
	}else{
		echo '<script type="text/javascript">
		Materialize.toast("Los datos no se actualizaron",4000,"rounded");
   </script>';
	};
    mysqli_close($conexion);
	}
  ?>