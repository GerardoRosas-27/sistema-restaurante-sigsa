<?php
include('../bd/conexionbd.php');
    if (!$conexion) 
	{
      die('Conexión fallida a la BD: ' . mysqli_error($conexion));
    }
$user=$_POST['no'];
$contra=$_POST['co'];
 

$consulta="SELECT ADMINISTRADORES.IdAdmin,ADMINISTRADORES.Nombre,ADMINISTRADORES.Contrasena FROM ADMINISTRADORES WHERE ADMINISTRADORES.Nombre='".$user."' AND ADMINISTRADORES.Contrasena='".$contra."'"; 
$buscar=mysqli_query($conexion,$consulta);
    while($row = mysqli_fetch_array($buscar)) 
    {
        if($user==$row['Nombre'] && $contra==$row['Contrasena']){
            session_start();
            $_SESSION['idadmin']=$row['IdAdmin'];
            $_SESSION['usuario']=$user;
            $_SESSION['contra']=$contra;
            echo 'valido';
        }
     
    } 

mysqli_close($conexion);
?>