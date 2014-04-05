<?
  include_once("php/sesion.php"); 
?>
<!DOCTYPE html>

<!-- HTML5 Boilerplate -->
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->


<? include("php/head.php") ?>
<script language="javascript" type="text/javascript" src="./js/jquery-1.10.2.min.js"> </script>
<script language="javascript" type="text/javascript" src="./js/jquery.validate.js" ></script>
<script language="javascript" type="text/javascript" src="./js/additional-methods.js" ></script>
<script language="javascript" type="text/javascript" src="./js/registrarse.js"></script>

<link rel="stylesheet" type="text/css" href="slider/engine1/style.css" />

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=596936237067988";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="wrapper">

    <div id="degrade_arriba"></div>
    <div id="degrade_abajo"></div>

    <div id="maincontent">

      <header>
          <a href="index.php"><img src="images/logo.png" alt="Fulbito" /></a>
          <div class="fb-follow" data-href="https://www.facebook.com/zuck" data-width="300" data-height="20" data-colorscheme="dark" data-layout="standard" data-show-faces="false"></div>
      </header>


      <div id="login" class="redondeado sombra">
        <?
        if(isset($_SESSION['error']))
        {
          print "<label class='errorLogin'>".htmlentities($_SESSION['error'])."</label>";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['ok']))
        {
          print "<label class='ok'>".htmlentities($_SESSION['ok'])."</label>";
          unset($_SESSION['ok']);
        }
        ?>
        <h1 style="margin-right:70px;">Bienvenido otra vez</h1>

         <form id="formIngresar" name="formIngresar" method="get" action="./procesaIngresar.php"  >

            <input id="correo" name="correo" type="text" placeholder="Correo eletronico"/><br>

            <input id="clave" name="clave" type="password" placeholder="Contrase&ntilde;a"/><br>

	    <input type="submit" id="ingresar" name="ingresar" value="Ingresar" >

        </form>



        <h1 style="margin-right:120px;">Eres nuevo?&nbsp;&nbsp;</h1>

        <form id="formRegistrarse" name="formRegistrarse" method="get" action="./procesaRegistracion.php"  >

		<input id="alias" name="alias" type="text" placeholder="Usuario"/><br>

		<input id="email" name="email" type="text" placeholder="Correo eletronico"/><br>

		<input id="password" name="password" type="password" placeholder="Contrase&ntilde;a"/><br>

		<input id="confirma_password" name="confirma_password" type="password" placeholder="Confirmar Contrase&ntilde;a"/><br>

		<input type="submit" id="registrar" name="registrar" value="Registrarme" >

        </form>



        <div style="clear:both; margin-top:20px;"></div>

        <a href=""><img src="images/registro-twitter.png" alt="" /></a>

        <a href=""><img src="images/registro-face.png" alt="" /></a>



        <a href="recuperarPassword.php" class="olvide">Olvide mi contrase&ntilde;a!</a>

      </div>

      <div id="login-derecha" class="redondeado sombra">
        <!-- Start WOWSlider.com BODY section -->
    	<div id="wowslider-container1">
      	  <div class="ws_images">
            <ul>
              <li><img src="images/jugar.jpg" alt="jugar" title="&iquest;Quer&eacute;s jugar al Futbol?" id="wows1_3"/></li>
              <li><img src="images/celus.jpg" alt="celus" title="Invita amigos y organiza partidos" id="wows1_1"/></li>
              <li><img src="images/comenta.jpg" alt="comenta" title="Comenta el partido con amigos" id="wows1_2"/></li>
              <li><img src="images/tablero.jpg" alt="tablero" title="Arma tus equipos" id="wows1_0"/></li>
            </ul>
          </div>
    	</div>
    	<script type="text/javascript" src="slider/engine1/wowslider.js"></script>
    	<script type="text/javascript" src="slider/engine1/script.js"></script>
    	<!-- End WOWSlider.com BODY section -->
      </div>

      <div id="login-noticias" class="sombra">
        <div id="titulo">Proximos partidos</div>
        <img src="images/pelota.png" alt="" />
        <p>Unite al partido de Adrian en San Justo<br>
        Faltan 3 jugadores</p>
        <div id="iz"><img src="images/iz.png" alt="" /></div>
        <div id="de"><a href=""><img src="images/de.png" alt="" /></a></div>
      </div>

      <div style='clear:both;'></div>

    </div>

    <? include("php/footer.php"); ?>

</div>



</body>

</html>