<?
	$usuario=$datos_perfil->row();
/*
TODO: acomodar foto
cartel delante del menu

Se utiliza esta pagina para cambiar las opciones de perfil.
Utiliza librerias Jquery: para el MAPA, para validar y para la fecha de nacimiento.

*/

?>
<!DOCTYPE html>

<head>
	
	<!-- Importante: la variable CI_ROOT se usa en JQUERY como base_url -->
	<script type="text/javascript">
        CI_ROOT = "<?=base_url() ?>";
    </script>

	<meta charset="utf-8">
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Fulbito</title>

	<meta http-equiv="cleartype" content="on">
	<!--<link rel="shortcut icon" href="/favicon.ico">-->

	<!-- Responsive and mobile friendly stuff -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/html5reset.css" media="all">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/style.css" media="all">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/validate.css" media="all">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/menu.css" type="text/css">
    
	<!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements and feature detects -->
	<script src="<?=base_url()?>assets/js/modernizr-2.5.3-min.js"></script>

</head>

<!-- HTML5 Boilerplate -->

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.10.2.min.js"> </script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.js" ></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/additional-methods.js" ></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/perfil.js"></script>

<!------------------------------------- MAPA ------------------------------------ http://ubilabs.github.io/geocomplete/  -->
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/ubilabs-geocomplete/jquery.geocomplete.js" ></script>
<!--<script language="javascript" type="text/javascript" src="./js/ubilabs-geocomplete/jquery.geocomplete.min.js" ></script>-->
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/mapa.js" ></script>
<!------------------------------------------------------------------------------------------------------------------------ -->

<!------------------------------------- FECHA ------------------------------------ http://jqueryui.com/datepicker/#dropdown-month-year  -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<!-- <script src="//code.jquery.com/jquery-1.9.1.js"></script> NO DESCOMENTAR TRAE INCOMPATIBILIDADES   -->
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<!------------------------------------------------------------------------------------------------------------------------ -->

<script>
  $(document).ready(function(){
    google.maps.event.addDomListener(window, 'load', initialize("<?=$usuario->LATITUD?>","<?=$usuario->LONGITUD?>","<?=$usuario->UBICACION?>"));
  })
</script>

<body>

<div id="wrapper">
	<div id="degrade_arriba"></div>
	<div id="degrade_abajo"></div>

    <? $this->load->view('templates/menu'); ?>
    
	<div id="maincontent">
		<header>
			<a href="index.php"><img src="<?=base_url()?>assets/images/logo.png" alt="Fulbito" /></a>
			<div class="fb-follow" data-href="https://www.facebook.com/zuck" data-width="300" data-height="20" data-colorscheme="dark" data-layout="standard" data-show-faces="false"></div>
		</header>

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

			<form id="formModificar" name="formModificar" action="<?=base_url()?>/index.php/perfil/modificar_datos_perfil" method="POST" enctype="multipart/form-data">

				<!----DATOS OBLIGATORIOS -->
				<input id="alias" name="alias" type="text" placeholder="Usuario" value="<? echo $usuario->ALIAS; ?>" /><br>
				<input id="email" name="email" type="text" placeholder="Correo eletronico" value="<? echo $usuario->MAIL; ?>" /><br>
				<input id="password" name="password" type="password" placeholder="Contrase&ntilde;a"/><br>
				<input id="confirma_password" name="confirma_password" type="password" placeholder="Confirmar Contrase&ntilde;a"/><br>

				<!----DATOS OPCIONALES -->
				<input id="telefono" name="telefono" type="text" placeholder="Celular o telefono" <? if( isset($usuario->TELEFONO) ) echo "value='$usuario->TELEFONO'"; ?>/><br>
				<input id="datepicker" name="datepicker" type="text" placeholder="Fecha de Nacimiento" <? if( isset($usuario->FECHA_NACIMIENTO) ) echo "value='$usuario->FECHA_NACIMIENTO'"; ?> /><br>
				<input type="radio" name="sexo" value="h" <? if( $usuario->SEXO == "h" ) echo "checked"; ?>  /> Hombre - <input type="radio" name="sexo" value="m" <? if( $usuario->SEXO == "m" ) echo "checked"; ?> /> Mujer <br>
				<input id="geocomplete" name="geocomplete" type="text" placeholder="Escriba su ciudad"  size="90" onchange="actualizar_mapa()" onkeypress="if(event.keyCode == 13){actualizar_mapa();}" <? if( isset($usuario->UBICACION) ) echo "value='$usuario->UBICACION'"; ?> /><br>
				Rango de busqueda de partidos en km.<br>
				<input id="radio" name="radio" type="range" <? if( isset($usuario->RADIO_BUSQUEDA_PARTIDOS) ) echo "value='$usuario->RADIO_BUSQUEDA_PARTIDOS'"; else echo "value='0'"; ?> min="0" max="100" placeholder="Radio de busqueda en KM" size="90" onchange="actualizar_radio()"/>
				<input id="radio2" name="radio2" type="text" <? if( isset($usuario->RADIO_BUSQUEDA_PARTIDOS) ) echo "value='$usuario->RADIO_BUSQUEDA_PARTIDOS'"; else echo "value='0'"; ?> style="width:40px;" onkeyup="actualizar_radio2()"/><br>

				<input name="lat" id="lat" type="hidden" value="<?=$usuario->LATITUD?>">
				<input name="lng" id="lng" type="hidden" value="<?=$usuario->LONGITUD?>">

				<input type="submit" name="modificar" value="Modificar" />
			</form>

		</div>

		<div id="modificar-mapa" class="redondeado sombra">
			<div id="map_canvas" class="map_canvas"></div>
		</div>
	
		<div id="modificar-foto" class="redondeado sombra">
	
			<form id="formModificarFoto" name="formModificarFoto" method="POST" action="<?=base_url()?>/index.php/perfil/modificar_foto_perfil" enctype="multipart/form-data" >
				<?
					$foto = $usuario->PATH_FOTO;

					if( $foto == "default.jpg" ): ?>
						<img src="<?=base_url()?>assets/images/thumbnails/default.jpg>">
				<?	else: ?>
						<img style="width:70px; height:85px;" src="<?=base_url()?>assets/images/thumbnails/<?=$usuario->PATH_FOTO?>">
				<?  endif ?>
				<input id="foto" name="userfile" type="file" placeholder="Foto de Perfil"/>
				<input type="submit" name="modificarFoto" id="modificarFoto" value="Modificar" />
			</form>
    	
		</div> 
		<?
		/*
		<?php echo form_open_multipart('perfil/upload_it');?>

					<input type="file" name="userfile" size="20" />

			<br /><br />

			<input type="submit" value="upload" />

			</form>*/ ?>
	</div>
</div>
</body>
