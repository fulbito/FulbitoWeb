<!DOCTYPE html>
<html>

<? $this->load->view('templates/head'); ?>

<body>

<div id="wrapper">
    <div id="degrade_arriba"></div>
    <div id="degrade_abajo"></div>
    <div id="maincontent">

    <? $this->load->view('templates/header'); ?> 
		
			<div id="login" class="redondeado sombra">

					  <h1 style="margin-right:70px;">Recuperar password</h1>

						<form id="formRecuperar" name="formRecuperar" method="post" action="<? $_SERVER['PHP_SELF']; ?>"  >
							<input id="email" name="email" type="text" placeholder="Correo eletronico"/><br>
							<input type="submit" id="enviar" name="enviar" value="Enviar" >
						</form>
			</div>		
    </div>
</div>


</body>
</html>