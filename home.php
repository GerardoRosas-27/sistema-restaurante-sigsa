<?php
session_start();


 $iniciadoU=$_SESSION['usuario'];
if($_POST['nombre']==$iniciadoU &&$_POST['contra']==$contra=$_SESSION['contra']){
    
}else{
     header("Location:sesion.html");
}
  $idAdmin=$_SESSION['idadmin'];
    $contra=$_SESSION['contra'];
if($iniciadoU==null||$iniciadoU==''){
  header("Location:sesion.html");
}   
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Menú de administración</title>
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- Materialize CSS -->
    <link rel="stylesheet" href="css/materialize.css">
    <!-- Material Design Iconic Font CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <!-- Malihu jQuery custom content scroller CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
    <!-- Sweet Alert CSS -->
    <link rel="stylesheet" href="css/sweetalert.css">
    <!-- MaterialDark CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/mapa.css">
    
</head>

<body>
   
    <!-- Nav Lateral -->
    <audio id="alerta" src="assets/audio/alerta.mp3" preload="auto"></audio>  
    <section class="NavLateral full-width">
        <div class="NavLateral-FontMenu full-width ShowHideMenu"></div>
        <div class="NavLateral-content full-width">
            <header class="NavLateral-title full-width center-align">
                Sigsa<i class="zmdi zmdi-close NavLateral-title-btn ShowHideMenu"></i>
            </header>
            <figure class="full-width NavLateral-logo">
                <img src="assets/img/logo.png" alt="material-logo" class="responsive-img center-box">
                <figcaption class="center-align">Sistema de Administración </figcaption>
            </figure>
            <div class="NavLateral-Nav">
                <ul class="full-width">
                    <li>
                        <a id="principal" class="waves-effect waves-light"><i class="large material-icons">insert_chart</i> Panel Principal</a>
                    </li>
                    <li class="NavLateralDivider"></li>
                 
                    <li class="NavLateralDivider"></li>
                    <li>
                        <a href="#" class="NavLateral-DropDown  waves-effect waves-light"><i class="zmdi zmdi-view-web zmdi-hc-fw"></i> <i class="zmdi zmdi-chevron-down NavLateral-CaretDown"></i>Operaciones </a>
                        <ul class="full-width">
                            <li><a id="menuP" class="waves-effect waves-light">Menú</a></li>
                            <li class="NavLateralDivider"></li>
                            <li><a id="platillos" class="waves-effect waves-light">Platillos</a></li>
                            <li class="NavLateralDivider"></li>
                            <li><a id="imagenes" class="waves-effect waves-light">Imágenes</a></li>
                            <li class="NavLateralDivider"></li>
                            <li><a id="admin" class="waves-effect waves-light">Administradores</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Page content -->
    <section class="ContentPage full-width">
        <!-- Nav Info -->
        <div class="ContentPage-Nav full-width">
            <ul class="full-width">
                <li class="btn-MobileMenu ShowHideMenu"><a href="#" class="tooltipped waves-effect waves-light" data-position="bottom" data-delay="50" data-tooltip="Menu"><i class="zmdi zmdi-more-vert"></i></a></li>
                <li>
                    <figure><img src="assets/img/user.png" alt="UserImage"></figure>
                </li>
                <li id="idAdmin" style="padding:0 5px;display:none;"><?php echo $idAdmin; ?></li>
                <li  style="padding:0 5px;"><?php echo $iniciadoU; ?></li>
                <li><a href="#" class="tooltipped waves-effect waves-light btn-ExitSystem" data-position="bottom" data-delay="50" data-tooltip="Cerrar Sesion"><i class="zmdi zmdi-power"></i></a></li>
              
                <li>
                    <a href="#" class="tooltipped waves-effect waves-light btn-Notification" data-position="bottom" data-delay="50" data-tooltip="Notificaciones">
						<i class="zmdi zmdi-notifications"></i>
						<span id="notificacion" class="ContentPage-Nav-indicator bg-danger">0</span>
					</a>
                </li>
            </ul>
        </div>
        <!-- Notifications area -->
        <section class="z-depth-3 NotificationArea">
            <div class="full-width center-align NotificationArea-title">Notifications <i class="zmdi zmdi-close btn-Notification"></i></div>
            <a href="#" class="waves-effect Notification">
                <div class="Notification-icon"><i class="zmdi zmdi-accounts-alt bg-info"></i></div>
                <div class="Notification-text">
                    <p>
                        <i class="zmdi zmdi-circle tooltipped" data-position="left" data-delay="50" data-tooltip="Notification as UnRead"></i>
                        <strong>New User Registration</strong>
                        <br>
                        <small>Just Now</small>
                    </p>
                </div>
            </a>
            <a href="#" class="waves-effect Notification">
                <div class="Notification-icon"><i class="zmdi zmdi-cloud-download bg-primary"></i></div>
                <div class="Notification-text">
                    <p>
                        <i class="zmdi zmdi-circle-o tooltipped" data-position="left" data-delay="50" data-tooltip="Notification as Read"></i>
                        <strong>New Updates</strong>
                        <br>
                        <small>30 Mins Ago</small>
                    </p>
                </div>
            </a>
            <a href="#" class="waves-effect Notification">
                <div class="Notification-icon"><i class="zmdi zmdi-upload bg-success"></i></div>
                <div class="Notification-text">
                    <p>
                        <i class="zmdi zmdi-circle tooltipped" data-position="left" data-delay="50" data-tooltip="Notification as UnRead"></i>
                        <strong>Archive uploaded</strong>
                        <br>
                        <small>31 Mins Ago</small>
                    </p>
                </div>
            </a>
            <a href="#" class="waves-effect Notification">
                <div class="Notification-icon"><i class="zmdi zmdi-mail-send bg-danger"></i></div>
                <div class="Notification-text">
                    <p>
                        <i class="zmdi zmdi-circle-o tooltipped" data-position="left" data-delay="50" data-tooltip="Notification as Read"></i>
                        <strong>New Mail</strong>
                        <br>
                        <small>37 Mins Ago</small>
                    </p>
                </div>
            </a>
            <a href="#" class="waves-effect Notification">
                <div class="Notification-icon"><i class="zmdi zmdi-folder bg-primary"></i></div>
                <div class="Notification-text">
                    <p>
                        <i class="zmdi zmdi-circle-o tooltipped" data-position="left" data-delay="50" data-tooltip="Notification as Read"></i>
                        <strong>Folder delete</strong>
                        <br>
                        <small>1 hours Ago</small>
                    </p>
                </div>
            </a>
        </section>
   
        <div class="row" id="contenedor">
        </div>
           
         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAR7w704943DI7DGQ6_yLV0RgxVu4Xv2SQ" async defer></script>

  <!---------Modal datos del Mapa---------->
 <div id="modalMapa" class="modal modal-fixed-footer">
<div class="modal-content">

<!--Input fields-->
<div class="container" id="mapa">

    </div>
    </div>
    <div class="modal-footer">
     <td>
       <a id="administradorUbi" type="submit" class="waves-effect waves-light btn">UBicación</a>
    
    <a id="btnCancelarUbicacion" class="
            modal-action waves-effect waves-light red btn">Cancelar</a>
    </td>

    </div>
</div>
 <!---------Fin modal----------> 
        <!-- Footer -->
        <footer class="footer-MaterialDark">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                       
                        <p class="grey-text text-lighten-12">
                            Somos un equipo de desarrollo jóvenes pero comprometidos, y con visión de la importancia que tienen las nuevas tecnologías en el desarrollo de la sociedad.
                        </p>
                    </div>
                   
                </div>
            </div>
            <div class="NavLateralDivider"></div>
            <div class="footer-copyright">
                <div class="container center-align">
                    © 2017 GIRATEC
                </div>
            </div>
        </footer>
    </section>
    <!-- Sweet Alert JS -->
    <script src="js/sweetalert.min.js"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="js/jquery-1.10.1.min.js"><\/script>')
    </script>
  
    <!-- Materialize JS -->
    <script src="js/materialize.js"></script>
    <!-- Malihu jQuery custom content scroller JS -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- MaterialDark JS -->
    <script src="js/main.js"></script>
   
    <script src="js/cargarCodigo.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/controladorAjax.js"></script>
    
</body>

</html>