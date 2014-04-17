<?
/*

Se utiliza esta pagina para cambiar las opciones de perfil.
Utiliza librerias Jquery: para el MAPA, para validar y para la fecha de nacimiento.

*/
include_once("php/sesion.php");
include_once("php/verificarSesion.php");
include_once("php/funciones/funcionesGenerales.php");

include_once "./php/clases/ezSQL-master/shared/ez_sql_core.php"; // Include ezSQL core (BD)
include_once "./php/clases/ezSQL-master/mysql/ez_sql_mysql.php"; // Include ezSQL mysql
include_once "./php/conexionBD.php"; // Conexion de la BD

global $db;


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

	  <div id="centro" class="sombra redondeado">
        <div class="boton_home" onclick="window.location.href='crearPartido.php'">
            <div class="boton_home_title">CREAR UN<br>PARTIDO</div>
            <img src="images/crear.png" alt="" />
            <p>Crea un partido publico o privado, elegi el lugar del encuentro y listo!</p>
        </div>
        <div class="boton_home" onclick="window.location.href='buscarPartido.php'">
            <div class="boton_home_title">BUSCAR<br>PARTIDOS</div>
            <img src="images/buscar.png" alt="" />
            <p>Busca un partido cerca tuyo y sumate!</p>
        </div>
      </div>

    </div>

    <? include("php/footer.php"); ?>

</div>

<? include("php/menu.php"); ?>

</body>

</html>