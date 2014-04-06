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
<link rel="stylesheet" type="text/css" href="css/menu.css">

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
      </div>

    </div>

    <? include("php/footer.php"); ?>

</div>

<ul id="gn-menu" class="gn-menu-main">
  <li class="gn-trigger">
  	<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
  	<nav class="gn-menu-wrapper">
  		<div class="gn-scroller">
  			<ul class="gn-menu">
  				<li class="gn-search-item">
  					<input placeholder="Search" class="gn-search" type="search">
  					<a class="gn-icon gn-icon-search"><span>Search</span></a>
  				</li>
  				<li>
  					<a class="gn-icon gn-icon-download">Downloads</a>
  					<ul class="gn-submenu">
  						<li><a class="gn-icon gn-icon-illustrator">Vector Illustrations</a></li>
  						<li><a class="gn-icon gn-icon-photoshop">Photoshop files</a></li>
  					</ul>
  				</li>
  				<li><a class="gn-icon gn-icon-cog">Settings</a></li>
  				<li><a class="gn-icon gn-icon-help">Help</a></li>
  				<li>
  					<a class="gn-icon gn-icon-archive">Archives</a>
  					<ul class="gn-submenu">
  						<li><a class="gn-icon gn-icon-article">Articles</a></li>
  						<li><a class="gn-icon gn-icon-pictures">Images</a></li>
  						<li><a class="gn-icon gn-icon-videos">Videos</a></li>
  					</ul>
  				</li>
  			</ul>
  		</div><!-- /gn-scroller -->
  	</nav>
  </li>
</ul>

<script src="js/classie.js"></script>
<script src="js/gnmenu.js"></script>
<script>
    new gnMenu( document.getElementById( 'gn-menu' ) );
</script>

</body>

</html>