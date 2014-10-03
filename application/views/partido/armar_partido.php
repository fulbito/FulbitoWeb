<!DOCTYPE html>

<!-- HTML5 Boilerplate -->
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif] -->

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

<body>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/slider/engine1/style.css" />

<div id="wrapper">

    <div id="degrade_arriba"></div>
    <div id="degrade_abajo"></div>

    <? $this->load->view('templates/menu'); ?>

    <div id="maincontent">
      <header>
          <a href="index.php"><img src="<?=base_url()?>assets/images/logo.png" alt="Fulbito" /></a>
          <div class="fb-follow" data-href="https://www.facebook.com/zuck" data-width="300" data-height="20" data-colorscheme="dark" data-layout="standard" data-show-faces="false"></div>
      </header>

	  <div id="centro" class="sombra redondeado">
        <h1>ARMAR EQUIPOS <?if(isset($partido['nombre'])) echo "para el partido".$partido['nombre'];?></h1>
        <div id="tablero">
            <img src="<?=base_url()?>assets/images/tablero2.jpg" alt="" />
        </div>
        <div id="jugadores">

        </div>
      </div>

    </div>
</div>



</body>


</html>

