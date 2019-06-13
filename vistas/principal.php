<?php
session_start();
 $iniciadoU=$_SESSION['usuario'];
  $idAdmin=$_SESSION['idadmin'];
    $contra=$_SESSION['contra'];
if($iniciadoU==null||$iniciadoU==''){
  header("Location:../sesion.html");
} 
?>
<article class="col s12">
                <div class="full-width center-align" style="margin: 40px 0;">   
                    <div class="tile">
                        <div class="tile-icon"><i class="zmdi zmdi-shopping-cart"></i></div>
                        <div class="tile-caption">
                            <span id="totalVentas" class="center-align">0</span>
                            <p class="center-align">Ventas</p>   
                        </div>
                        <a id="ventas" href="#" class="tile-link waves-effect waves-light">Ver detalles &nbsp; <i class="zmdi zmdi-caret-right-circle"></i></a>
                    </div>
                     <div class="tile">
                       <div class="tile-icon"><p for="">Fecha Inicio:  </p>
                       <p for="">Fecha Fin:  </p></div>
                        <div class="tile-caption">
                          
                        
                        <input id="fechainicio" type="date" style="margin-bottom:1px">
                          
                         
                          <input id="fechafin" type="date">
                          
                        </div>
                        <a id="formatofecha" class="tile-link waves-effect waves-light">Consultar Ventas &nbsp; <i class="zmdi zmdi-caret-right-circle"></i></a>
                    </div>
                    <div class="tile">
                        <div class="tile-icon"><i class="zmdi zmdi-shopping-cart"></i></div>
                        <div class="tile-caption">
                            <span id="totalVendidos" class="center-align">0</span>
                            <p class="center-align">Pedidos realizados hoy y vendidos</p>   
                        </div>
                        <a id="pedidosVendidos" href="#" class="tile-link waves-effect waves-light">Ver detalles &nbsp; <i class="zmdi zmdi-caret-right-circle"></i></a>
                    </div>
                     
                    <div class="tile">
                        <div class="tile-icon"><i class="zmdi zmdi-card"></i></div>
                        <div class="tile-caption">
                            <span class="center-align" id="actualizar">0</span>
                            <p class="center-align">Pedidos</p> 
                            
                        </div>
                        <a id="listapedidos" class="tile-link waves-effect waves-light">Ver detalles &nbsp; <i class="zmdi zmdi-caret-right-circle"></i></a>
                    </div>
                     
                </div> 
                  
            </article>

            <!-- Timeline -->
            <article id="conten-detalles" class="col s12">
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
                <div class="fb-comments" data-href="http://127.0.0.1:51985/index.html" data-width="100%" data-numposts="5"></div>
            </article>
<script src="./js/controladorAjax.js"></script>