<?php
include('../bd/conexionbd.php');
    if (!$conexion) 
	{
      die('Conexión fallida a la BD: ' . mysqli_error($conexion));
    }
$user=$_POST['noc'];
$contra=$_POST['coc'];


$consulta="SELECT CLIENTESREGISTRADOS.NombreCompleto,CLIENTESREGISTRADOS.IdCliente,CLIENTESREGISTRADOS.Usuario,CLIENTESREGISTRADOS.Contrasena,CLIENTESREGISTRADOS.Telefono FROM CLIENTESREGISTRADOS WHERE CLIENTESREGISTRADOS.Usuario='".$user."' AND CLIENTESREGISTRADOS.Contrasena='".$contra."'"; 
$buscar=mysqli_query($conexion,$consulta);
    while($row = mysqli_fetch_array($buscar)) 
    {
        if($user==$row['Usuario'] && $contra==$row['Contrasena']){     
            session_start();
            $_SESSION['nombre']=$row['NombreCompleto'];
            $_SESSION['telefono']=$row['Telefono'];
            $_SESSION['idc']=$row['IdCliente'];
            $_SESSION['usu']=$user;
            $_SESSION['contrac']=$contra;
            echo 'valido';
        }
    } 
mysqli_close($conexion);
?>