<!DOCTYPE html>
<html>

<? $this->load->view('templates/head'); ?>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/slider/engine1/style.css" />

<body>
<div id="fb-root"></div>

<div id="wrapper">

    <div id="degrade_arriba"></div>
    <div id="degrade_abajo"></div>

    <div id="maincontent">

      <? $this->load->view('templates/header'); ?>


      <div id="login" class="redondeado sombra">
		  
        <?	if(isset($mensaje_error)): ?>
				<label class='errorLogin'><?=$mensaje_error?></label>
		<? 		unset($mensaje_error);
			endif;	?>

		<?	if(isset($mensaje_exito)): ?>
				<label class='ok'><?=$mensaje_exito?></label>
		<? 		unset($mensaje_exito);
			endif;	?>
		
       
        <h1 style="margin-right:70px;">Bienvenido otra vez</h1>
        <form id="formIngresar" name="formIngresar" method="post" >

            <input id="correo" name="correo" type="text" placeholder="Correo eletronico"/><br>
            <input id="clave" name="clave" type="password" placeholder="Contrase&ntilde;a"/><br>
	        <input type="submit" id="ingresar" name="ingresar" value="Ingresar">

        </form>



        <h1 style="margin-right:120px;">Eres nuevo?&nbsp;&nbsp;</h1>
        <form id="formRegistracion" name="formRegistracion" method="post" >
    		<input id="alias" name="alias" type="text" placeholder="Usuario"/><br>
    		<input id="email" name="email" type="text" placeholder="Correo eletronico"/><br>
    		<input id="password" name="password" type="password" placeholder="Contrase&ntilde;a"/><br>
    		<input id="confirma_password" name="confirma_password" type="password" placeholder="Confirmar Contrase&ntilde;a"/><br>
    		<input type="submit" id="registrar" name="registrar" value="Registrarme" >
        </form>

        <div style="clear:both; margin-top:20px;"></div>
			<a href=""><img src="<?=base_url()?>assets/images/registro-twitter.png" alt="" /></a>
			<a href=""><img src="<?=base_url()?>assets/images/registro-face.png" alt="" /></a>
			<?=anchor('login/recuperar_password/', ' <span class="olvide">Olvide mi contrase&ntilde;a!</span>', 'title="Traer contactos que desistieron"');?>
		</div>

		<div id="login-derecha" class="redondeado sombra">
        <!-- Start WOWSlider.com BODY section -->
    	<div id="wowslider-container1">
      	  <div class="ws_images">
            <ul>
              <li><img src="<?=base_url()?>assets/images/jugar.jpg" alt="jugar" title="&iquest;Quer&eacute;s jugar al Futbol?" id="wows1_3"/></li>
              <li><img src="<?=base_url()?>assets/images/celus.jpg" alt="celus" title="Invita amigos y organiza partidos" id="wows1_1"/></li>
              <li><img src="<?=base_url()?>assets/images/comenta.jpg" alt="comenta" title="Comenta el partido con amigos" id="wows1_2"/></li>
              <li><img src="<?=base_url()?>assets/images/tablero.jpg" alt="tablero" title="Arma tus equipos" id="wows1_0"/></li>
            </ul>
          </div>
    	</div>
    	<script type="text/javascript" src="<?=base_url();?>assets/slider/engine1/wowslider.js"></script>
    	<script type="text/javascript" src="<?=base_url();?>assets/slider/engine1/script.js"></script>
    	<!-- End WOWSlider.com BODY section -->
      </div>

      <div id="login-noticias" class="sombra">
        <div id="titulo">Proximos partidos</div>
        <img src="<?=base_url()?>assets/images/pelota.png" alt="" />
        <p>Unite al partido de Adrian en San Justo<br>
        Faltan 3 jugadores</p>
        <div id="iz"><img src="<?=base_url()?>assets/images/iz.png" alt="" /></div>
        <div id="de"><a href=""><img src="<?=base_url()?>assets/images/de.png" alt="" /></a></div>
      </div>

      <div style='clear:both;'></div>

    </div>

</div>



</body>

</html>
