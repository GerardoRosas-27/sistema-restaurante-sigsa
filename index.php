
<?php
error_reporting(0);
session_start();
$inic=$_SESSION['usu'];
$idcli=$_SESSION['idc'];
$contrac=$_SESSION['contrac'];
$nombre=$_SESSION['nombre'];
$telefono=$_SESSION['telefono'];


if($_POST['usuarioS']=="" && $_POST['contraS']==""){
    $idc="";
if($inic==null||$inic==''){
 $idc="";
}
}else{
    $idc=$idcli;
}

?>
<!DOCTYPE html5>
<html lang="es">

<head>
    <title>Comida Oriental Sigsa</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-
	scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">

    <meta http-equiv="Pragma" content="no-cache">
    <link rel="stylesheet" href="csspg/materialize.css">
    <link rel="stylesheet" href="csspg/styles.css">
    <link rel="stylesheet" href="csspg/estilos.css">
    <link href="csspg/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="csspg/mapa.css">
    <script src="js/jquery-1.10.1.min.js"></script>
    <script src="js/Saltos.js"></script>
</head>

<body>
  
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.10';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <div id="Casa" style=" width: 100%; height: 800px;" data-vide-bg="videopg/banner" data-vide-options=" loop: false, silenciado: false, posición: 0% 0% ">
        </ div>
        <header class="header" id="menu">
            <div class="contenedor">
                <h1 class="logo"><img src="imgpg/Sigsa-v6.png" alt="" class="logo__sigsa" id="sigsa"></h1>
                <span class="icon-menu" id="btn-menu"></span>
                <nav class="nav" id="nav">
                    <ul class="menu">
                        <li class="menu__item"><a class="menu__link waves-effect waves-light" href="#Casa">Casa</a></li>
                        <li class="menu__item"><a class="menu__link waves-effect waves-light" href="#Platillos">Platillos</a></li>
                        <li class="menu__item"><a class="menu__link waves-effect waves-light" href="#Conocenos">Conócenos</a></li>
                        <li class="menu__item"><a class="menu__link waves-effect waves-light" id="btnClientes">Clientes</a></li>
                        <li class="menu__item"><a class="menu__link waves-effect waves-light" href="sesion.html">Administrador</a></li>
                      
                        <li id="idCliente" style="display:none"><?php echo $idc ?></li>

                    </ul>
                
                </nav>
            </div>
        </header>
        <div class="banner">
            <div class="contenedor" id="banner">
                <h2 class="banner__titulo">El buen comer está en "Sigsa". </h2>
                <p class="banner__txt">Nuestros platillos son elaborados con ingredientes frescos del día</p>
            </div>
        </div>
        <div id="Platillos">
        </div>

        <div id="scrolling">
            <?php
    setlocale(LC_ALL,"es_ES");
    include('bd/conexionbd.php');
    if (!$conexion) 
	{
      die('Conexión fallida a la BD: ' . mysqli_error($conexion));
    }
    $dias = array('Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo');
$fecha = $dias[date('N')]; 
    $sql="SELECT PLATILLOS.ClavePlatillo,PLATILLOS.Nombre AS 'NombreP',PLATILLOS.Precio,IMAGENES.Nombre AS 'NombreI',MENU.Promociones,MENU.HorarioApertura,MENU.HorarioCierre FROM PLATILLOS,IMAGENES,MENU WHERE MENU.Dia='".$fecha."' AND PLATILLOS.IdMenu=MENU.IdMenu AND PLATILLOS.Imagen=IMAGENES.ClaveImg";
    $result = mysqli_query($conexion,$sql);

       $sql1="SELECT MENU.HorarioApertura,MENU.HorarioCierre FROM MENU WHERE MENU.Dia='".$fecha."'";
     $result1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($result1)){
    
echo'<h1 class="menu_platillos" id="menu-dia">
    Menú del '.$fecha.' Abierto de '.$row1['HorarioApertura'].' a '.$row1['HorarioCierre'].'</h1>';
}
echo'<ul class="class_lu">';
   
    while($row = mysqli_fetch_array($result)){
        echo'<li class="class_li">
        <div class="conte-slider">

            <img src="assets/img/'.$row['NombreI'].'" alt="" class="info__img">
            <p>'.$row['NombreP'].'</p>
            <p>$'.$row['Precio'].' MX</p>
            <p>'.$row['Promociones'].'</p>
            <a id="btnAgregar" data-id="'.$row['ClavePlatillo'].'" data-np="'.$row['NombreP'].'" data-pre="'.$row['Precio'].'"
            data-img="'.$row['NombreI'].'"  class="mas">ORDENAR</a>
        </div>
    </li>';
     }  
echo'</ul>';   
  
?>
        </div>
        <div id="listaTabla">
            <div id="remover" class="row ocultar">
                <table class="responsive-table" id="tablaP">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Arroz</th>
                            <th>Pasta</th>
                            <th>Salsas</th>
                            <th>Total</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody style="transition: all 1.4s;">
                        <tr>
                        </tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td id="total"></td>
                        <td> <button id="enviarMub" type="submit" class="waves-effect waves-light btn">DIRECCIÓN</button>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="respuesta">

        </div>
        <!---------Modal agregar Platillos---------->
        <div id="modalAG" class="modal modal-fixed-footer">
            <div class="modal-content">

                <!--Input fields-->
                <div class="container">
                    <div class="row">
                        <h4 class="center-align">Personaliza tu platillo</h4>
                        <form autocomplete="off" class="col s12" name="formAgregar">
                            <div class="row">
                                <div class="input-field col s12">
                                    <h5>Cantidad de platillos</h5>
                                    <div class="input-field col s12">
                                        <p class="range-field">
                                            <input id="rango" name="rango" type="range" size="20" value="1" min="1" max="10" />
                                        </p>
                                    </div>
                                    <div class="input-field col s6">
                                        <input disabled type="text" id="valor" name="valor" value="1">

                                    </div>
                                </div>

                                <div id="modalimg" class="input-field col s12">

                                </div>
                                <div class="input-field col m6">
                                    <h5 type="text" id="nombre" name="nombre"></h5>
                                </div>
                                <div class="input-field col s6">
                                    <h5 type="text" id="cantidad" name="cantidad"></h5>
                                </div>
                                <div class="input-field col s12">
                                    <div class="input-field col m3" style="margin-left: 20px;">
                                        <p>Arroz $15.00 MX</p>
                                        <input type="button" value="+" id="mas">
                                        <input disabled name="quantity" id="arroz" value="0" size="4" />
                                        <input type="button" value="-" id="menos" style="width: 26px;">
                                    </div>
                                    <div class="input-field col m3" style="margin-left: 20px;">
                                        <p>Pasta $15.00 MX</p>
                                        <input type="button" value="+" id="mas1">
                                        <input disabled name="quantity1" id="pasta" value="0" size="4" />
                                        <input type="button" value="-" id="menos1" style="width: 26px;">
                                    </div>
                                    <div class="input-field col m3" style="margin-left: 20px;">
                                        <p>Salsas $5.00 MX</p>
                                        <input type="button" value="+" id="mas2">
                                        <input disabled name="quantity2" id="salsa" value="1" size="2" />
                                        <input type="button" value="-" id="menos2" style="width: 26px;">
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <td>
                    <button id="btnAgregarLista" type="submit" class="modal-action waves-effect waves-light btn">Agregar</button>
                    <a id="btnCancelar" class="
            modal-action waves-effect waves-light red btn">Cancelar</a>
                </td>

            </div>
        </div>
        <!---------Fin modal---------->

        <!---------Modal datos de Ubicacion---------->
        <div id="modalUB" class="modal modal-fixed-footer">
            <div class="modal-content">

                <!--Input fields-->
                <div class="container">
                    <div class="row">
                        <h4 class="center-align">Ingresa la dirección</h4>
                        <form autocomplete="off" class="col s12" name="formAgregar">
                            <div class="row">
                                <div class="input-field col s12">
                                    <p>Coordenadas de tu ubicación</p>
                                    <input type="text" id="ubicacion" name="valor" readonly="readonly">
                                </div>
                                <div class="input-field col s6">
                                    <input id="colonia" type="text" class="validate">
                                    <label for="colonia">Colonia</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="calles" type="text" class="validate">
                                    <label for="calles">Calles</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="numcasa" type="text" class="validate">
                                    <label for="numcasa">Número de Casa</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="referencias" type="text" class="validate">
                                    <label for="referencias">Referencias</label>
                                </div>
                                <div id="mapCliente" class="input-field col s6">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <td>
                    <a href="#Conocenos" id="clienteUB" type="submit" class="waves-effect waves-light btn">Activar Ubicación</a>
                    <button id="btnEnviarDatos" type="submit" class="modal-action waves-effect waves-light btn">ENVIAR PEDIDO</button>
                    <a id="btnCancelarUB" class="
            modal-action waves-effect waves-light red btn">Cancelar</a>
                </td>
            </div>
        </div>
        <!---------Fin modal---------->
        <!---------Modal Lista de espera---------->
        <div id="modalLista" class="modal modal-fixed-footer">
            <div class="modal-content">
                <!--Input fields-->
                <div class="container">
                    <div class="row">
                        <h4 class="center-align">Lista de espera</h4>
                        <form autocomplete="off" class="col s12" name="formAgregar">
                            <div class="row">
                                <div id="listaEspera" class="input-field col s12">
                                    <span id="numeroLista"></span>
                                    <span id="estadoL"></span>
                                </div>

                                <div id="listaPendientes" class="input-field col s12">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <td>
                    <a id="btnCancelarLista" class="
            modal-action waves-effect waves-light red btn">Cancelar</a>
                </td>
            </div>
        </div>
        <!---------Fin modal ---------->
        <div id="Conocenos">
        </div>
        <button class="waves-effect waves-light" id="boton">¿Cómo llego?</button>
         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAR7w704943DI7DGQ6_yLV0RgxVu4Xv2SQ&callback=ubicacionSigsa" async defer></script>
        
        <div id="map">
        </div>
        <div class="fb-comments" data-href="http://127.0.0.1:51985/index.html" data-width="100%" data-numposts="5"></div>

 
        <div id="btnCarrito" class="fixed-action-btn horizontal click-to-toggle ocultar">
            <a class="modalEspera btn-floating btn-large red icon-compras"></a>
            <span class="modalEspera" id="pedidosR">0</span>

        </div>
        

        <!---------Modal Clientes Iniciar sesión---------->
        <div id="modalClientes" class="modal modal-fixed-footer">
            <div class="modal-content">
                <!--Input fields-->
                <div class="container">
                    <div class="row">
                        <h4 class="center-align">Iniciar Sesión</h4>

                        <form autocomplete="off" class="col s12" action="index.php" method="post" name="form2" id="form2">
                            <div class="row">
                              
                                 <div class="input-field col s12">
                                    <input name="usuarioS" id="usuarioC1" type="text" class="validate">
                                    <label for="icon_prefix">Nombre de usuario</label>
                                </div>
                               
                                <div class="input-field col s12">
                                    <input name="contraS" id="contraC1" type="password" class="validate">
                                    <label for="contra">Contraseña</label>
                                </div>
                                   <div class="input-field col s12">
                                 <span id="respuestaCliente" style="color: red;"></span>
                                </div>
                                
                            </div>
                        </form>
                  
                    </div>
                </div>
            </div>
            <div class="modal-footer">
               <td>
                <a id="btnCrear" class="
            modal-action waves-effect waves-light btn blue">Crear Cuenta</a>
                </td>
                <td>
                    <a id="btnClientesS" class="
            modal-action waves-effect waves-light btn">Iniciar</a>
                </td>
                <td>
                    <a id="btnCancelarClientesS" class="
            modal-action waves-effect waves-light red btn">Cancelar</a>
                </td>
            </div>
        </div>
        <!---------Fin modal ---------->
        <!---------Modal Clientes Crear cuenta---------->
        <div id="modalClientesCrear" class="modal modal-fixed-footer">
            <div class="modal-content">
                <!--Input fields-->
                <div class="container">
                    <div class="row">
                        <h4 class="center-align">Crear cuenta</h4>

                        <form autocomplete="off" class="col s12" name="formAgregar">
                            <div class="row">
                                <div class="input-field col s12">
                                    
                                    <input id="nombre" type="text" class="validate">
                                    <label for="icon_prefix">Nombre completo</label>
                                </div>
                                 <div class="input-field col s12">
                                    <input id="usuario" type="text" class="validate">
                                    <label for="icon_prefix">Nombre de usuario</label>
                                </div>
                                <div class="input-field col s12">
                                    <input id="contra1" type="password" class="validate">
                                    <label for="contra">Contraseña</label>
                                </div>
                                <div class="input-field col s12">
                                    <input id="contra2" type="password" class="validate">
                                    <label for="contra">Repite la contraseña</label>
                                </div>
                                <div id="tel" class="input-field col s12">
                                    <input id="telefono" type="tel" class="validate">
                                    <label for="icon_telephone">Teléfono</label>
                                </div>
                              
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           
            <div class="modal-footer">
                <td>
                    <a id="btnClientesC" class="
            modal-action waves-effect waves-light btn">Iniciar</a>
                </td>
                <td>
                    <a id="btnCancelarClientesC" class="
            modal-action waves-effect waves-light red btn">Cancelar</a>
                </td>
            </div>
        </div>
        <!---------Fin modal ---------->
        <!---------Modal Clientes Crear cuenta---------->
        <div id="modalDatosCliente" class="modal modal-fixed-footer">
            <div class="modal-content">
                <!--Input fields-->
                <div class="container">
                    <div class="row">
                        <h4 class="center-align">Datos de tu cuenta</h4>

                        <form autocomplete="off" class="col s12" name="formAgregar">
                            <div class="row">
    
                                <div class="input-field col s12">
                             <span>Usuario: </span>
                                  <span><?php echo  $inic ?></span>
                                 
                                </div>
                                 <div class="input-field col s12">
                                    <span>Nombre: </span>
                                     <span><?php echo  $nombre ?></span>
                                </div>
                                <div class="input-field col s12">
                                    <span>Teléfono:</span>
                                     <span><?php echo  $telefono ?></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           
            <div class="modal-footer">
                <td>
                    <a id="btnCerrarSC" class="
            modal-action waves-effect waves-light btn">Cerrar sesión</a>
                </td>
                <td>
                    <a id="btnCancelarDC" class="
            modal-action waves-effect waves-light red btn">Cancelar</a>
                </td>
            </div>
        </div>
        <footer class="footer">
            <div class="social">
                <a href="https://www.facebook.com/pg/ComedorOriental/about/" class="icon-facebook"></a>
                <a class="icon-whapsat tooltipped" data-position="bottom" data-delay="50" data-tooltip="01 756 103 4002"></a>
            </div>
            <img src="imgpg/LOGO-GIRATEC.png" alt="" class="giratec">
            <p class="copy">&copy; Tolos los derechos reservados</p>
        </footer>
        <script src="js/materialize.min.js"></script>
        <script src="js/Mapa.js"></script>
        <script src="js/menu.js"></script>
         <script src="js/controladorSeciones.js"></script>
        <script src="js/jquery.vide.min.js"></script>
        <script src="js/itemslide.min.js"></script>
        <script src="js/jquery.mousewheel.min.js"></script>
        <script src="js/sliding.js"></script>
</body>

</html>