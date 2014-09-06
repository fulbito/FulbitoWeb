<?
  /*
  include_once("php/sesion.php");
   if(isset($_SESSION['id'])) // si no esta setiado el id
   {
     $locationIndex = "./home.php";
     $tiempo =0;
     print "<META HTTP-EQUIV=\"Refresh\"  CONTENT=\"$tiempo; URL=$locationIndex\">";
   }

   include_once "debugger/ChromePhp.php";
   ChromePhp::log('INDEX!');*/
   
?>
<!DOCTYPE html>

<!-- HTML5 Boilerplate -->
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif] -->


<? //include("php/head.php") ?>
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

<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.10.2.min.js"> </script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.js" ></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/additional-methods.js" ></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/js/login.js"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/slider/engine1/style.css" />

<div id="wrapper">

    <div id="degrade_arriba"></div>
    <div id="degrade_abajo"></div>

    <div id="maincontent">
      <header>
          <a href="index.php"><img src="<?=base_url()?>assets/images/logo.png" alt="Fulbito" /></a>
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
</div>

</body>


</html>

