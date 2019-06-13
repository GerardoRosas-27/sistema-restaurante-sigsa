<?php
session_start();
 $iniciadoU=$_SESSION['usuario'];
  $idAdmin=$_SESSION['idadmin'];
    $contra=$_SESSION['contra'];
if($iniciadoU==null||$iniciadoU==''){
  header("Location:../sesion.html");
}   
$tabla=$_POST['tabla'];
include('../bd/conexionbd.php');
    if (!$conexion) 
	{
      die('Conexión fallida a la BD: ' . mysqli_error($conexion));
    }
switch ($tabla) 
    {
    case 'IMAGENES':
       imagenes($conexion);
        break;
    case 'PLATILLOS':
        platillos($conexion);
        break;
    case 'MENU':
        menu($conexion);
        break;
	case 'ADMINISTRADORES':
        admin($conexion);
        break;
    default:
        echo "esta regla es por defecto";
    };
function imagenes($conexion){
    $sql="SELECT * FROM IMAGENES";
    $result = mysqli_query($conexion,$sql);
echo'<div class="container" style="margin-bottom: 128px;">		
 <div class="row">
 <h5 class="center-align">IMÁGENES</h5>
		<a id="btn-modal" class="btn-floating btn-large waves-effect waves-light green"><i class="zmdi zmdi-plus"></i></a> 
<div class="col s12">		
<table class="responsive-table">
    <thead>
        <tr>
            <th>CLAVE IMAGEN</th>
            <th>NOMBRE</th>
			 <th>IMAGEN</th>
			  <th>OPCIONES</th>
        </tr>
    </thead>
    <tbody>';
	 while($row = mysqli_fetch_array($result)) 
                {
      echo'<tr><font></font>
            <td>'.$row['ClaveImg'].'</td>
            <td>'.$row['Nombre'].'</td>
			<td><img src="./assets/img/'.$row['Nombre'].'" alt="" style="max-width: 30%;max-height: 30%;"></td>
			  <td><button class="waves-effect waves-light red btn" id="btnEliminarImg" data-id="'. $row['ClaveImg'] .'"><i class="zmdi zmdi-minus"></i></button></td>
			  <td><button class="waves-effect waves-light btn" id="btnEditarImg" data-id="'. $row['ClaveImg'] .'" value="'.$row['Nombre'].'"><i class="zmdi zmdi-edit"></i></button></td>
        </tr>';
       }
  echo'</tbody>
</table>
</div>
</div>
</div>';	
	echo'<!---------Modal guardar Imagenes---------->
         <div id="modalGI" class="modal modal-fixed-footer">
          <div class="modal-content">
            
            <!--Input fields-->
<div class="container">
	<div class="row">
		<h4 class="center-align">Elige una imagen o arrastrala</h4>
		<form autocomplete="off" class="col s12" id="form-subir" enctype="multipart/form-data">
			<div class="row">
			<div class="file-field input-field col s12">
				<div class="btn">
					<span>Archivo</span>
					<input type="file" name="files" id="files">
				</div>
				<div class="file-path-wrapper">
					<input id="nombre-img" class="file-path validate" type="text" required>
				</div>
                 <br/>
                   <button  id="btnValidar" type="submit" class="modal-action waves-effect waves-light btn" value="">Guardar</button>
             <output class="col s12" id="list"></output>
			</div>
		</div>
		 
		</form>
	</div>
</div>
          </div>
          <div class="modal-footer">
           <td>
            <a id="btnCancelar" class="
            modal-action waves-effect waves-light red btn">Cancelar</a>
            </td>
			
          </div>
        </div>
        <!---------Fin modal---------->';
	echo'<!---------Modal Actualizar Imagenes---------->
         <div id="modalAI" class="modal modal-fixed-footer">
          <div class="modal-content">
            
            <!--Input fields-->
<div class="container">
	<div class="row">
		<h4 class="center-align">Elige una imagen o arrastrala</h4>
		<form autocomplete="off" class="col s12" id="form-actualizar">
			<div class="row">
			<div class="file-field input-field col s12">
				<div class="btn">
					<span>Archivo</span>
					<input type="file" name="archivo">
				</div>
				<div class="file-path-wrapper">
					<input id="nombre-imga" class="file-path validate" type="text" name="nombreimg">
					<input id="id" type="text" name="id" style="display:none">
					<input id="eliminar" type="text" name="eliminar" style="display:none">
					<input id="tabla" type="text" name="tabla" style="display:none">
				</div>
			</div>
		</div>
		
		<td>
           <input type="submit" class="modal-action waves-effect waves-light btn" value="Actualizar">
        </td>
		
		</form>
	</div>
</div>
          </div>
          <div class="modal-footer">
           <td>
            <a href="#!" class="
            modal-action modal-close waves-effect waves-light red btn">Cancelar</a>
            </td>
          </div>
        </div>
        <!---------Fin modal---------->
		';
	echo '
	<script src="./js/controladorAjax.js"></script>';

mysqli_close($conexion);  
};

function platillos($conexion){
      
	$sql="SELECT PLATILLOS.IdPlatillo,PLATILLOS.ClavePlatillo,PLATILLOS.Nombre,PLATILLOS.Cantidad,PLATILLOS.Precio,IMAGENES.Nombre AS 'NombreP',IMAGENES.ClaveImg AS 'ClaveImg',PLATILLOS.IdMenu,MENU.Dia FROM PLATILLOS,IMAGENES,MENU WHERE PLATILLOS.Imagen=IMAGENES.ClaveImg AND PLATILLOS.IdMenu=MENU.IdMenu";
    $platillos = mysqli_query($conexion,$sql);

echo '<div class="container" style="margin-bottom: 128px;">
	<div class="row">
		<h5 class="center-align">PLATILLOS</h5>
		<a id="btn-modal" class="btn-floating btn-large waves-effect waves-light green"><i class="zmdi zmdi-plus"></i></a>  
		<div class="col s12">
			<table class="responsive-table">
				<thead>
					<tr>
					
						<th data-field="id">CLAVE PLATILLO</th>
						<th data-field="name">NOMBRE</th>
						<th data-field="name">CANTIDAD</th>
						<th data-field="name">PRECIO</th>
						<th data-field="name">IMAGEN</th>
						<th data-field="name">NOMBRE IMG</th>
                        <th data-field="name">DÍA</th>
						<th data-field="option">OPCIONES</th>
						
					</tr>
				</thead>
				<tbody>';
				 while($row = mysqli_fetch_array($platillos)) 
                {
					echo'<tr>';
					
					echo'<td>'.$row['ClavePlatillo'].'</td>';
					echo'<td>'.$row['Nombre'].'</td>';
					 echo'<td>'.$row['Cantidad'].'</td>';
					 echo'<td>'.$row['Precio'].'</td>';
					echo '<td>
					    <img src="./assets/img/'.$row['NombreP'].'" alt="" style="max-width: 40%;max-height: 40%;">';
					echo '</td>';
					echo'<td>'.$row['NombreP'].'</td>';
                    echo'<td>'.$row['Dia'].'</td>';
					echo '<td>
					 <button class="waves-effect waves-light red btn" id="btnEliminarP" data-id="'. $row['IdPlatillo'] .'"><i class="zmdi zmdi-minus"></i></button>		
	                 <button class="waves-effect waves-light btn" id="btnEditarP" data-id="'. $row['IdPlatillo'] .'" data-img="'.$row['ClaveImg'].'" data-dia="'.$row['IdMenu'].'"><i class="zmdi zmdi-edit"></i></button>
	                 </td>';
                     echo "</tr>";
                }
          echo '</tbody>
			</table>
		</div>
	</div>

</div>';
echo'<!---------Modal guardar Platillos---------->
<div id="modalGI" class="modal modal-fixed-footer">
	<div class="modal-content">

		<!--Input fields-->
		<div class="container">
			<div class="row">
				<h4 class="center-align">Guardar Platillos</h4>
				<form class="col s12" autocomplete="off" id="form-platillos">
					<div class="row">
						<div class="input-field col s6">
							<input  id="clavePlatillo" type="text" class="validate">
							<label for="clavePlatillo">Clave del Platillo</label>
						</div>
						<div class="input-field col s6">
							<input id="nombrePlatillo" type="text" class="validate">
							<label for="nombrePlatillo">Nombre del platillo</label>
						</div>
						
					</div>
					
					<div class="row">
						<div class="input-field col s6">
							<input id="cantidadPlatillo" type="text" class="validate">
							<label for="cantidadPlattillo">Cantidad de los platillo</label>
						</div>
				       <div class="input-field col s6">
							<input id="precioPlatillo" type="text" class="validate">
							<label for="precioPlatillo">Precio del platillo</label>
                         </div>
                        
				      </div>
                      <div class="row">
                      	  <input  id="idMenu" type="text" style="display:none;">
						 </div>
                       
                      <div class="row">
					   
					    <ul class="collapsible" data-collapsible="accordion">
						  <li>
							<div class="collapsible-header">
							<input  id="menuDiaP" type="text" placeholder="Elige Un día" readonly="readonly">
							</div>
							<div class="collapsible-body">
							<table class="responsive-table">
							<tbody>';
	
							$img="SELECT MENU.IdMenu,MENU.Dia,MENU.Promociones FROM MENU";
							$menu = mysqli_query($conexion,$img);
							 while($row = mysqli_fetch_array($menu)) 
							 { 
							
							echo'<tr>
							<td>
							
							<button class="waves-effect waves-light btn" id="btnSelectMenu" data-idm="'.$row['IdMenu'] .'" data-dia="'.$row['Dia'] .'">Seleccionar</button>
	                        </td>
							<td>'.$row['Dia'].'</td>
							<td>'.$row['Promociones'].'</td>
							 </tr>';
							 }
	       
							echo'</tbody>
							</table>
							</div>
						  </li>
					    </ul>
					   
					</div>
                      
						<div class="row">
                      	  <input  id="id" type="text" style="display:none">
						 </div>
					
				</form>
				</div>
					<div class="row">
					   
					    <ul class="collapsible" data-collapsible="accordion">
						  <li>
							<div class="collapsible-header">
							<input  id="nombreimg" type="text" placeholder="Elige una imagen" readonly="readonly">
							</div>
							<div class="collapsible-body">
							<table class="responsive-table">
							<tbody>';
	
							$img="SELECT IMAGENES.ClaveImg,IMAGENES.Nombre FROM IMAGENES";
							$platillos = mysqli_query($conexion,$img);
							 while($row = mysqli_fetch_array($platillos)) 
							 { 
							
							echo'<tr>
							<td>
							
							<button class="waves-effect waves-light btn" id="btnSeleccionGurdarP"  data-idimg="'.$row['ClaveImg'] .'" data-nom="'.$row['Nombre'].'">Seleccionar</button>
	                        </td>
							<td>'.$row['Nombre'].'</td>
							<td><img src="./assets/img/'.$row['Nombre'].'" alt="" style="max-width: 40%;max-height: 40%">
							
							</td>
							 </tr>';
							 }
	       
							echo'</tbody>
							</table>
							</div>
						  </li>
					    </ul>
					   
					</div>
		</div>

	</div>
	<div class="modal-footer">
	
		<td>
		<button class="waves-effect waves-light btn" id="btnGuardarPlatillos">Guardar</button>
		<a id="btnCancelar" class="
		modal-action waves-effect waves-light red btn">Cancelar</a>
			
		</td>

	</div>
</div>
<!---------Fin modal---------->';

echo'<!---------Modal Actualizar Platillos---------->
         <div id="modalAI" class="modal modal-fixed-footer">
       <div class="modal-content">

		<!--Input fields-->
		<div class="container">
			<div class="row">
				<h4 class="center-align">Actualizar Platillos</h4>
				<form class="col s12" autocomplete="off" id="form-platillos">
					<div class="row">
						<div class="input-field col s6">
							<input  id="clavePlatilloA" type="text" class="validate">
							<label for="clavePlatillo">Clave del Platillo</label>
						</div>
						<div class="input-field col s6">
							<input id="nombrePlatilloA" type="text" class="validate">
							<label for="nombrePlatillo">Nombre del platillo</label>
						</div>
						
					</div>
					
					<div class="row">
						<div class="input-field col s6">
							<input id="cantidadPlatilloA" type="text" class="validate">
							<label for="cantidadPlattillo">Cantidad de los platillo</label>
						</div>
							<div class="input-field col s6">
							<input id="precioPlatilloA" type="text" class="validate">
							<label for="precioPlatillo">Precio del platillo</label>
						
						</div>
                       </div> 
                        
                        <div class="row">
                      	  <input  id="idMenuA" type="text" style="display:none;">
						 </div>
                       
                      <div class="row">
					   
					    <ul class="collapsible" data-collapsible="accordion">
						  <li>
							<div class="collapsible-header">
							<input  id="menuDiaPA" type="text" placeholder="Elige Un día" readonly="readonly">
							</div>
							<div class="collapsible-body">
							<table class="responsive-table">
							<tbody>';
	
							$img="SELECT MENU.IdMenu,MENU.Dia,MENU.Promociones FROM MENU";
							$menu = mysqli_query($conexion,$img);
							 while($row = mysqli_fetch_array($menu)) 
							 { 
							
							echo'<tr>
							<td>
							
							<button class="waves-effect waves-light btn" id="btnSelectMenuA" data-idm="'.$row['IdMenu'] .'" data-dia="'.$row['Dia'] .'">Seleccionar</button>
	                        </td>
							<td>'.$row['Dia'].'</td>
							<td>'.$row['Promociones'].'</td>
							 </tr>';
							 }
	       
							echo'</tbody>
							</table>
							</div>
						  </li>
					    </ul>
					   
					</div>
                        
						<div class="row">
                      	<input  id="idA" type="text" style="display:none">
						</div>
					
				</form>
				</div>
					<div class="row">
					   
					    <ul class="collapsible" data-collapsible="accordion">
						  <li>
							<div class="collapsible-header">
							<input  id="nombreimgA" type="text" placeholder="Elige una imagen" readonly="readonly">
							</div>
							<div class="collapsible-body">
							<table class="responsive-table">
							<tbody>';
	
							$img="SELECT IMAGENES.ClaveImg AS 'IdImg',IMAGENES.Nombre AS 'NombreI' FROM PLATILLOS,IMAGENES WHERE PLATILLOS.Imagen=IMAGENES.ClaveImg";
							$platillos = mysqli_query($conexion,$img);
							 while($row = mysqli_fetch_array($platillos)) 
							 { 
							
							echo'<tr>
							<td>
							
							<button class="waves-effect waves-light btn" id="btnSeleccionActualizarP"  value="'.$row['IdImg'] .'" data-id="'.$row['NombreI'].'">Seleccionar</button>
	                        </td>
							<td>'.$row['NombreI'].'</td>
							<td><img src="./assets/img/'.$row['NombreI'].'" alt="" style="max-width: 30%;max-height: 30%">
							
							</td>
							 </tr>';
							 }
	       
							echo'</tbody>
							</table>
							</div>
						  </li>
					    </ul>
					</div>
		</div>
	</div>
          <div class="modal-footer">
          <td>
           <button id="btnActulizarP" class="modal-action waves-effect waves-light btn">Actualizar</button>
        </td>
           <td>
            <a href="#!" class="
            modal-action modal-close waves-effect waves-light red btn">Cancelar</a>
            </td>
   
          </div>
        </div>
        <!---------Fin modal---------->

<script src="./js/controladorAjax.js"></script>';
	
mysqli_close($conexion);  
};
//funcion cargar datos de menu
function menu($conexion){
		$sql="SELECT * FROM MENU ORDER BY IdMenu";
    $menu = mysqli_query($conexion,$sql);

echo '<div class="container" style="margin-bottom: 128px;">
	<div class="row">
		<h5 class="center-align">MÉNU</h5>
		<a id="btn-modal" class="btn-floating btn-large waves-effect waves-light green"><i class="zmdi zmdi-plus"></i></a>  
		<div class="col s12">
			<table class="responsive-table">
				<thead>
					<tr>
					
						<th data-field="id">CLAVE MENÚ</th>
						<th data-field="name">DÍA</th>
						<th data-field="name">PROMOCIONES</th>
						<th data-field="name">HORA APERTURA</th>
						<th data-field="name">HORA CIERRE</th>
						<th data-field="option">OPCIONES</th>
						
					</tr>
				</thead>
				<tbody>';
				 while($row = mysqli_fetch_array($menu)) 
                {
					echo'<tr>';
					echo'<td>'.$row['IdMenu'].'</td>';
					echo'<td>'.$row['Dia'].'</td>';
					 echo'<td>'.$row['Promociones'].'</td>';
					 echo'<td>'.$row['HorarioApertura'].'</td>';
					echo '<td>'.$row['HorarioCierre'].'</td>';
					echo '<td>
					 <button class="waves-effect waves-light red btn" id="btnEliminarMenu" data-id="'. $row['IdMenu'] .'"><i class="zmdi zmdi-minus"></i></button>		
	                 <button class="waves-effect waves-light btn" id="btnEditarM" data-id="'. $row['IdMenu'] .'"><i class="zmdi zmdi-edit"></i></button>
	                 </td>';
                     echo "</tr>";
                }
          echo '</tbody>
			</table>
		</div>
	</div>

</div>';
echo'<!---------Modal guardar Menu---------->
<div id="modalGI" class="modal modal-fixed-footer">
	<div class="modal-content">
		<!--Input fields-->
		<div class="container">
			<div class="row">
				<h4 class="center-align">Guardar Menú</h4>
				<form class="col s12" autocomplete="off" id="form-platillos">
                
                 <div class="row">
					   
					    <ul class="collapsible" data-collapsible="accordion">
						  <li>
							<div class="collapsible-header">
							<input  id="diaMenuG" type="text" placeholder="Selecciona un día" readonly="readonly">
							</div>
							<div class="collapsible-body">
							
							
							<td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDiaG"  value="Lunes">Lunes</button>
	                        </td>
                            <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDiaG"  value="Martes">Martes</button>
	                        </td>
                            <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDiaG"  value="Miércoles">Miércoles</button>
	                        </td>
                             <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDiaG"  value="Jueves">Jueves</button>
	                        </td>
                             <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDiaG"  value="Viernes">Viernes</button>
	                        </td>
                               <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDiaG"  value="Sábado">Sábado</button>
	                        </td>
                               <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDiaG"  value="Domingo">Domingo</button>
	                        </td>
					
							</div>
						  </li>
					    </ul>
		</div>
                <div class="row">
			         <div class="input-field col s12">
							<input  id="promocionM" type="text" class="validate">
							<label for="promocion">promocion del día</label>
						</div>
				 </div>
					
					
					<div class="row">
						<div class="input-field col s6">
							<input  id="horaapeM" type="text" class="timepicker">
							<label for="horaape">Hora de apertura</label>
						</div>
						<div class="input-field col s6">
							<input id="horacierM" type="text" class="timepicker">
							<label for="horacier">Hora de cierre</label>
						</div>	
					</div> 
				</form>
				</div>	
		</div>
	</div>
	<div class="modal-footer">
		<td>
		<button class="waves-effect waves-light btn" id="btnGuardarMenu">Guardar</button>
		<a id="btnCancelar" class="
		modal-action waves-effect waves-light red btn">Cancelar</a>
		</td>
	</div>
</div>
<!---------Fin modal---------->';
echo'<!---------Modal Actualizar Menu---------->
         <div id="modalAI" class="modal modal-fixed-footer">
       <div class="modal-content">
		<!--Input fields-->
		<div class="container">
			<div class="row">
				<h4 class="center-align">Actualizar Menú</h4>
				<form class="col s12" autocomplete="off" id="form-menu">
                
                
                <div class="row">
					   
					    <ul class="collapsible" data-collapsible="accordion">
						  <li>
							<div class="collapsible-header">
							<input  id="diaMenuActualizar" type="text" placeholder="Selecciona un día" readonly="readonly">
							</div>
							<div class="collapsible-body">
							
							
							<td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDia"  value="Lunes">Lunes</button>
	                        </td>
                            <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDia"  value="Martes">Martes</button>
	                        </td>
                            <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDia"  value="Miércoles">Miércoles</button>
	                        </td>
                             <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDia"  value="Jueves">Jueves</button>
	                        </td>
                             <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDia"  value="Viernes">Viernes</button>
	                        </td>
                               <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDia"  value="Sábado">Sábado</button>
	                        </td>
                               <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDia"  value="Domingo">Domingo</button>
	                        </td>
					
							</div>
						  </li>
					    </ul>
					</div>
					<div class="row">
                       
    
			          <div class="input-field col s12">
							<input  id="promocionMA" type="text" class="validate">
							<label for="promocion">promocion del día</label>
						</div>
						
						
					</div>
					
					<div class="row">
						<div class="input-field col s6">
							<input  id="horaapeMA" type="text" class="timepicker">
							<label for="horaape">Hora de apertura</label>
						</div>
						<div class="input-field col s6">
							<input id="horacierMA" type="text" class="timepicker">
							<label for="horacier">Hora de cierre</label>
						</div>	
					</div> 
				</form>
				</div>	
		</div>
	</div>
          <div class="modal-footer">
          <td>
           <button id="btnActulizarM" class="modal-action waves-effect waves-light btn">Actualizar</button>
        </td>
           <td>
            <a href="#!" class="
            modal-action modal-close waves-effect waves-light red btn">Cancelar</a>
            </td>
          </div>
        </div>
        <!---------Fin modal---------->
<script src="./js/controladorAjax.js"></script>';
mysqli_close($conexion);  
}
function admin($conexion){
		$sql="SELECT*FROM ADMINISTRADORES";
    $admin = mysqli_query($conexion,$sql);
echo '<div class="container" style="margin-bottom: 128px;margin-bottom: 400px;">
	<div class="row">
		<h5 class="center-align">ADMINISTRADORES</h5>
		<a id="btn-modalAdmin" class="btn-floating btn-large waves-effect waves-light green"><i class="zmdi zmdi-plus"></i></a>  
		<div class="col s12">
			<table class="responsive-table">
				<thead>
					<tr>
						<th data-field="id">CLAVE USUARIO</th>
						<th data-field="name">NOMBRE</th>
						<th data-field="option">OPCIONES</th>
					</tr>
				</thead>
				<tbody>';
				 while($row = mysqli_fetch_array($admin)) 
                {
					echo'<tr>';
					echo'<td>'.$row['IdAdmin'].'</td>';
					echo'<td>'.$row['Nombre'].'</td>';
					echo '<td>
					 <button class="waves-effect waves-light red btn" id="btnEliminarAdmin" data-id="'. $row['IdAdmin'] .'"><i class="zmdi zmdi-minus"></i></button></td>	
					 <td><button class="waves-effect waves-light btn" id="btnEditarAdmin" data-contra="'. $row['Contrasena'] .'" data-nombre="'. $row['Nombre'] .'" data-id="'. $row['IdAdmin'] .'"><i class="zmdi zmdi-edit"></i></button>
	                 </td>';
                     echo "</tr>";
                }
          echo '</tbody>
			</table>
		</div>
	</div>
</div>
<!---------Modal guardar administradores---------->
<div id="modalGAdmin" class="modal modal-fixed-footer">
	<div class="modal-content">

		<!--Input fields-->
		<div class="container">
			<div class="row">
				<h4 class="center-align">Guardar Administradores</h4>
				<form class="col s12" autocomplete="off" id="form-platillos">
					<div class="row">
						<div class="input-field col s6">
							<input  id="nombreAdmin" type="text" class="validate">
							<label for="NombreAdmin">Nombre del administrador</label>
						</div>
						<div class="input-field col s6">
							<input id="contraAdmin" type="password" class="validate">
							<label for="contraAdmin">Contra seña del administrador</label>
						</div>
			</div>
            </div>
		</div>

	</div>
	<div class="modal-footer">
	
		<td>
		<button class="waves-effect waves-light btn" id="btnGuardarAdmin">Guardar</button>
		<a id="btnCancelarAdmin" class="
		modal-action waves-effect waves-light red btn">Cancelar</a>
			
		</td>

	</div>
</div>
<!---------Fin modal---------->';

echo'<!---------Modal actualizar administradores---------->
<div id="modalAAdmin" class="modal modal-fixed-footer">
	<div class="modal-content">

		<!--Input fields-->
		<div class="container">
			<div class="row">
				<h4 class="center-align">Actualizar Administradores</h4>
				<form class="col s12" autocomplete="off" id="form-platillos">
					<div class="row">
						<div class="input-field col s6">
							<input  id="nombreAdminA" type="text" class="validate">
							<label for="NombreAdminA">Nombre del administrador</label>
						</div>
						<div class="input-field col s6">
							<input id="contraAdminA" type="password" class="validate">
							<label for="contraAdminA">Contra seña del administrador</label>
						</div>
						
					</div>
		</div>
        </div>

	</div>
	<div class="modal-footer">
	
		<td>
		<button class="waves-effect waves-light btn" id="btnActualizarAdmin">Actualizar</button>
		<a id="btnCancelarAdminA" class="
		modal-action waves-effect waves-light red btn">Cancelar</a>
			
		</td>

	</div>
</div>
<!---------Fin modal---------->

<script src="./js/controladorAjax.js"></script>';
mysqli_close($conexion);
}

?>