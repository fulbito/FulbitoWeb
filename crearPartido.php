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
<script language="javascript" type="text/javascript" src="./js/crearPartido.js"></script>

<!------------------------------------- FECHA ------------------------------------ http://jqueryui.com/datepicker/#dropdown-month-year  -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<!-- <script src="//code.jquery.com/jquery-1.9.1.js"></script> NO DESCOMENTAR TRAE INCOMPATIBILIDADES   -->
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<!------------------------------------- HORA ------------------------------------ http://www.ajaxshake.com/demo/ES/211/2eeeb5d9/plugin-jquery-selector-de-tiempo-timepicker-clockpick.html -->
<script language="javascript" type="text/javascript" src="./js/jquery.clockpick.1.2.9"></script>
<link rel="stylesheet" href="./css/jquery.clockpick.1.2.9.css">

<link rel="stylesheet" type="text/css" href="slider/engine1/style.css" />

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=596936237067988";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>



<div id="wrapper">

    <div id="degrade_arriba"></div>
    <div id="degrade_abajo"></div>

    <div id="maincontent">

      <header>
          <a href="index.php"><img src="images/logo.png" alt="Fulbito" /></a>
          <div class="fb-follow" data-href="https://www.facebook.com/zuck" data-width="300" data-height="20" data-colorscheme="dark" data-layout="standard" data-show-faces="false"></div>
      </header>

	  <div id="centro" class="sombra redondeado">

      <? if(!isset($_POST['aceptar']))
         {   ?>
	  		<form id="formCrearPartido" method="POST" name="formCrearPartido" action="<?php $_SERVER['PHP_SELF'] ?>">

				<input id="nombrePartido" name="nombrePartido" type="text" placeholder="Nombre del Partido" /><br>
			    <input id="datepicker" name="datepicker" type="text" placeholder="Fecha del Partido" /><br>
				<input id="hora" name="hora" type="text" placeholder="Hora del Partido" /><br>
				<input id="duracion" name="duracion" type="text" placeholder="Duracion del Partido" /><br>
                <input id="nombreCancha" name="nombreCancha" type="text" placeholder="Nombre del club" /><br>

                <? $tipos = $db->get_results("SELECT * FROM TIPO_PARTIDO");

                   foreach($tipos AS $row)
                    {  ?>
                        <input type="radio" name="tipoPartido" id="tipoPartido" value="<? echo $row->ID; ?>" /> <? echo $row->DESCRIPCION; ?>
                <?  }  ?>
                <br>
	  			<input id="cantidadJugadores" name="cantidadJugadores" type="text" placeholder="Cantidad de Jugadores" /><br>
	  			<input id="cantidadSuplentes" name="cantidadSuplentes" type="text" placeholder="Cantidad de Suplentes" /><br>

                <? $tipos = $db->get_results("SELECT * FROM TIPO_PERIODICIDAD");

                   foreach($tipos AS $row)
                    {  ?>
                        <input type="radio" name="tipoPeriodicidad" id="tipoPeriodicidad" value="<? echo $row->ID; ?>" />  <? echo $row->DESCRIPCION; ?>
                <?  }  ?>
                <br> 
                <input type="submit" name="aceptar" id="aceptar" value="Crear Partido" />
             </form>
       <?
         }
         else
         {
            $idUsuarioadmin=$_SESSION['id'];
            $fecha =  $_POST['datepicker'];
            $hora =  $_POST['hora'];

            $consulta ="INSERT INTO  `a6003835_fulbito`.`partido` (
                          `ID` ,
                          `ID_CANCHA` ,
                          `ID_TIPO_PARTIDO` ,
                          `ID_TIPO_PERIODICIDAD` ,
                          `ID_ESTADO_PARTIDO` ,
                          `ID_USUARIO` ,
                          `NOMBRE` ,
                          `FECHA` ,
                          `HORA` ,
                          `DURACION` ,
                          `CANT_JUGADORES` ,
                          `CANT_SUPLENTES`
                          )
                          VALUES ( '',  '',  '',  '',  '',  '$idUsuarioadmin',".esVacio($_POST['nombrePartido']).",  '$fecha',  '$hora',".esVacio($_POST['duracion']).",".esVacio($_POST['cantidadJugadores']).",".esVacio($_POST['cantidadSuplentes']).")";

            echo $consulta;

            $db->query($consulta);

            if($db->rows_affected > 0)
                 echo "Su partido se ha creado exitosamente";
            else
                 echo "No se ha podido crear su partido";
               /*
            //  Tipo de partido
			if(isset($_POST['tipoPartido']) && !empty($_POST['tipoPartido']) )
			{
				//$consulta.= ", PASSWORD = '$password' ";
			}

            //  Periodicidad
			if(isset($_POST['tipoPartido']) && !empty($_POST['tipoPartido']) )
			{
				//$consulta.= ", PASSWORD = '$password' ";
			}               */

         }
      ?>

      </div>

    </div>

    <? include("php/footer.php"); ?>

</div>

<? include("php/menu.php"); ?>

</body>

</html>