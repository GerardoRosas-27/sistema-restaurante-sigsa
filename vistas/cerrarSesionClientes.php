<?php
session_start();

 $inic=$_SESSION['usu'];

  $idcli=$_SESSION['idc'];
    $contrac=$_SESSION['contrac'];
if($inic==null||$inic==''){
  header("Location:../index.php");
}else{
    //session_destroy();
    $inic=$_SESSION['usu']="";
$idcli=$_SESSION['idc']="";
$contrac=$_SESSION['contrac']="";
$nombre=$_SESSION['nombre']="";
$telefono=$_SESSION['telefono']="";
    header("Location:../index.php");
}

?>