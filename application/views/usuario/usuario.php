<?
	$usuario= $datos_usuario->row();
	$id_usuario =  $this->session->userdata('id');
?>

<!DOCTYPE html>
<html>
<? $this->load->view('templates/head'); ?>

<!------------------------------------- MAPA ------------------------------------ -->
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/ubilabs-geocomplete/jquery.geocomplete.js" ></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/mapa.js" ></script>
<!------------------------------------------------------------------------------------------------------------------------ -->

<!------------------------------------- FECHA ------------------------------------ >
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<!------------------------------------------------------------------------------------------------------------------------ -->

<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/perfil.js"></script>

<script>
  $(document).ready(function(){
    google.maps.event.addDomListener(window, 'load', initialize("<?=$usuario->latitud?>","<?=$usuario->longitud?>","<?=$usuario->ubicacion?>"));
  })
</script>

<body>

<div id="wrapper">
	<div id="degrade_arriba"></div>
	<div id="degrade_abajo"></div>

    <? $this->load->view('templates/menu'); ?>
    
	<div id="maincontent">
        <? $this->load->view('templates/header'); ?> 

		<div id="modificar" class="redondeado sombra">
			
			<?	if(isset($mensaje_error)): ?>
						<label class='errorLogin'><?=$mensaje_error?></label>
				<? 		unset($mensaje_error);
				endif;	?>

			<?	if(isset($mensaje_exito)): ?>
						<label class='ok'><?=$mensaje_exito?></label>
				<? 		unset($mensaje_exito);
				endif;	?>

			<h1 >Modificar Perfil</h1>

			<form id="formModificar" name="formModificar" action="<?=base_url()?>index.php/usuario/modificar_datos_usuario" method="POST" enctype="multipart/form-data">
				
				
				<input id="id_usuario" name="id_usuario" type="hidden" value="<? echo $id_usuario; ?>" />
				<!----DATOS OBLIGATORIOS -->
				<input id="alias" name="alias" type="text" placeholder="Usuario" value="<? echo $usuario->alias; ?>" /><br>
				<input id="email" name="email" type="text" disabled placeholder="Correo eletronico" value="<? echo $usuario->email; ?>" style='background: #424242;' /><br>
				<input id="password" name="password" type="password" placeholder="Contrase&ntilde;a"/><br>
				<input id="confirma_password" name="confirma_password" type="password" placeholder="Confirmar Contrase&ntilde;a"/><br>

				<!----DATOS OPCIONALES -->
				<input id="telefono" name="telefono" type="text" placeholder="Celular o telefono" <? if( isset($usuario->telefono) ) echo "value='$usuario->telefono'"; ?>/><br>
				<input id="datepicker" name="datepicker" type="text" placeholder="Fecha de Nacimiento" <? if( isset($usuario->fecha_nacimiento) ) echo "value='$usuario->fecha_nacimiento'"; ?> /><br>
				<input type="radio" name="sexo" value="h" <? if( $usuario->sexo == "h" ) echo "checked"; ?>  /> Hombre - <input type="radio" name="sexo" value="m" <? if( $usuario->sexo == "m" ) echo "checked"; ?> /> Mujer <br>
				<input id="geocomplete" name="geocomplete" type="text" placeholder="Escriba su ciudad"  size="90" onchange="actualizar_mapa()" onkeypress="if(event.keyCode == 13){actualizar_mapa();}" <? if( isset($usuario->ubicacion) ) echo "value='$usuario->ubicacion'"; ?> /><br>
				Rango de busqueda de partidos en km.<br>
				<input id="radio" name="radio" type="range" <? if( isset($usuario->radio_busqueda_partido) ) echo "value='$usuario->radio_busqueda_partido'"; else echo "value='0'"; ?> min="0" max="100" placeholder="Radio de busqueda en KM" size="90" onchange="actualizar_radio()"/>
				<input id="radio2" name="radio2" type="text" <? if( isset($usuario->radio_busqueda_partido) ) echo "value='$usuario->radio_busqueda_partido'"; else echo "value='0'"; ?> style="width:40px;" onkeyup="actualizar_radio2()"/><br>

				<input name="lat" id="lat" type="hidden" value="<?=$usuario->latitud?>">
				<input name="lng" id="lng" type="hidden" value="<?=$usuario->longitud?>">

				<input type="submit" name="modificar" value="Modificar" />
				
			</form>

		</div>

		<div id="modificar-mapa" class="redondeado sombra">
			<div id="map_canvas" class="map_canvas"></div>
		</div>
	
		<div id="modificar-foto" class="redondeado sombra">
			<?	if(isset($mensaje_foto_error)): ?>
						<label class='errorLogin'><?=$mensaje_foto_error?></label>
				<? 		unset($mensaje_foto_error);
				endif;	?>

			<?	if(isset($mensaje_foto_exito)): ?>
						<label class='ok'><?=$mensaje_foto_exito?></label>
				<? 		unset($mensaje_foto_exito);
				endif;	?>
				
			<form id="formModificarFoto" name="formModificarFoto" method="POST" action="<?echo base_url();?>index.php/usuario/modificar_foto_perfil" enctype="multipart/form-data" >
				<?
					$foto = $usuario->foto;

					if( $foto == "default.jpg" ): ?>
						<img style="width:75px; height:85px; padding:3px; background-color:#000;" src="<?=base_url()?>assets/images/fotos_usuario/default.jpg">
				<?	else: ?>
						<img style="width:75px; height:85px;" src="<?=base_url()?>assets/images/fotos_usuario/foto_web/<?=$usuario->foto?>">
				<?  endif ?>
				<input id="foto" name="userfile" type="file" placeholder="Foto de Perfil"/>
				<input type="submit" name="modificarFoto" id="modificarFoto" value="Modificar" />
			</form>
    	
		</div> 
	</div>
</div>
</body>

</html>