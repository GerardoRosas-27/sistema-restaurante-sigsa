<?php
session_start();
 $iniciadoU=$_SESSION['usuario'];
  $idAdmin=$_SESSION['idadmin'];
    $contra=$_SESSION['contra'];
if($iniciadoU==null||$iniciadoU==''){
  header("Location:../sesion.html");
}   
    $id = $_POST['datos'];
    $tabla = $_POST['tabla'];
    $campo = $_POST['campo'];

    include('../bd/conexionbd.php');
    if (!$conexion) 
    {
      die('Conexión fallida a la BD: ' . mysqli_error($conexion));
    }
if($tabla=="IMAGENES"){
	$consulta="SELECT Nombre FROM ".$tabla." WHERE ".$campo."=".$id;
    $nombre=mysqli_query($conexion,$consulta);
	while($fila=mysqli_fetch_array($nombre))
			{
				$Nombre=$fila['Nombre'];
		@unlink('../assets/img/'.$Nombre);
			}
	
	eliminar($conexion,$tabla,$campo,$id);
}else{
	eliminar($conexion,$tabla,$campo,$id);
}
function eliminar($conexion,$tabla,$campo,$id){
	

    $eliminar="DELETE FROM ".$tabla." WHERE ".$campo."=".$id;
    $query=mysqli_query($conexion,$eliminar);
	if($query!=null){
		echo '<script type="text/javascript">
    Materialize.toast("Los datos se eliminaron correctamente",4000,"rounded");
	
   </script>';
	}else{
		echo '<script type="text/javascript">
    Materialize.toast("Los datos no se pudieron eliminar, esposible que esten relacionados",4000,"rounded");
   </script>';
	};
    mysqli_close($conexion);
	}
  ?>