<?
/*
TODO: acomodar foto
cartel delante del menu

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

$id_us = $_SESSION['id'];

$usuario = $db->get_row("SELECT *
                         FROM USUARIO AS u LEFT JOIN DATOS_OPCIONALES_USUARIO AS d
                         ON ( u.ID = d.ID_USUARIO )
                         WHERE u.ID = '$id_us' ");

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
<script language="javascript" type="text/javascript" src="./js/modificarPerfil.js"></script>

<!------------------------------------- MAPA ------------------------------------ http://ubilabs.github.io/geocomplete/  -->
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->
<script language="javascript" type="text/javascript" src="./js/ubilabs-geocomplete/jquery.geocomplete.js" ></script>
<!--<script language="javascript" type="text/javascript" src="./js/ubilabs-geocomplete/jquery.geocomplete.min.js" ></script>-->
<script language="javascript" type="text/javascript" src="./js/mapa.js" ></script>

<!------------------------------------- FECHA ------------------------------------ http://jqueryui.com/datepicker/#dropdown-month-year  -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<!-- <script src="//code.jquery.com/jquery-1.9.1.js"></script> NO DESCOMENTAR TRAE INCOMPATIBILIDADES   -->
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script>
  $(document).ready(function(){
    google.maps.event.addDomListener(window, 'load', initialize("<?=$usuario->LATITUD?>","<?=$usuario->LONGITUD?>","<?=$usuario->UBICACION?>"));
  })
</script>

<body>



<div id="wrapper">

	<div id="degrade_arriba"></div>
	<div id="degrade_abajo"></div>

	<div id="maincontent">

		<header>
		<a href="index.php"><img src="images/logo.png" alt="Fulbito" /></a>
		<div class="fb-follow" data-href="https://www.facebook.com/zuck" data-width="300" data-height="20" data-colorscheme="dark" data-layout="standard" data-show-faces="false"></div>
		</header>

		<div id="modificar" class="redondeado sombra">

        <?
         if(!isset($_POST['modificar']))
	     {
             if(isset($_SESSION['datosError']))
            {
              print "<label class='errorLogin'>".htmlentities($_SESSION['datosError'])."</label>";
              unset($_SESSION['datosError']);
            }

            if(isset($_SESSION['datosOk']))
            {
              print "<label class='ok'>".htmlentities($_SESSION['datosOk'])."</label>";
              unset($_SESSION['datosOk']);
            }

            ?>

            <h1 >Modificar Perfil</h1>
			<form id="formModificar" name="formModificar" method="POST" action="<? $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

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

	<?	}
		else
		{
            $alias = $_POST['alias'];
			$email = $_POST['email'];

			$consulta = "UPDATE  USUARIO SET MAIL = '$email', ALIAS = '$alias' ";

            //  Si cambio el password
			if(isset($_POST['password']) && !empty($_POST['password']) )
			{
				$password = md5($_POST['password']);
				$consulta.= ", PASSWORD = '$password' ";
			}

			$consulta.=" WHERE ID = '$id_us'  ";

			$db->query($consulta);

			if($db->rows_affected > 0)
			    $_SESSION['datosOk']= "Se han modificado los datos correctamente.";
            else
                $_SESSION['datosError']= "No se han modificado los datos, intente mas tarde.";

            //-------------- TRABAJA CON LOS DATOS OPCIONALES ------------------------//

           	$db->query("SELECT * FROM DATOS_OPCIONALES_USUARIO WHERE ID_USUARIO = $id_us ");

            if($db->num_rows > 0) // ACTUALIZAR DATOS OPCIONALES
            {
                $contador = 0;
                $consultaActulizarOpcionales="UPDATE DATOS_OPCIONALES_USUARIO SET ";

                if( isset($_POST['telefono']) && !empty($_POST['telefono']) )    // FECHA DE NACIMIENTO
                {
                  $contador = 1;
                  $telefono =$_POST['telefono'];
                  $consultaActulizarOpcionales.="TELEFONO = '$telefono'";
                }

                if( isset($_POST['sexo']) && !empty($_POST['sexo']) )    // FECHA DE SEXO
                {
                   if($contador == 1)
                     $consultaActulizarOpcionales.="," ;
                  $contador = 1;
                  $sexo =$_POST['sexo'];
                  $consultaActulizarOpcionales.="SEXO = '$sexo'";
                }

                if( isset($_POST['datepicker']) && !empty($_POST['datepicker']) )    // FECHA DE NACIMIENTO
                {
                  if($contador == 1)
                     $consultaActulizarOpcionales.="," ;
                  $contador = 1;

                  $fechaNacimiento=$_POST['datepicker'];
                  $consultaActulizarOpcionales.=" FECHA_NACIMIENTO = '$fechaNacimiento' ";
                }

                if( isset($_POST['geocomplete']) && !empty($_POST['geocomplete']) )    // LLENAR CIUDAD, LATITUD, LONGITUD
                {
                  if($contador == 1)
                    $consultaActulizarOpcionales.="," ;

                  $contador = 1;

                  $ciudad =$_POST['geocomplete'];
                  $latitud =$_POST['lat'];
                  $longitud =$_POST['lng'];
                  $consultaActulizarOpcionales.=" UBICACION = '$ciudad' , LATITUD = '$latitud' , LONGITUD = '$longitud' ";
                }

                 if( isset($_POST['radio']) && !empty($_POST['radio']) )    // LLENAR CIUDAD, LATITUD, LONGITUD
                {
                  if($contador == 1)
                    $consultaActulizarOpcionales.="," ;

                  $contador = 1;

                  $radio =$_POST['radio'];
                  $consultaActulizarOpcionales.=" RADIO_BUSQUEDA_PARTIDOS = '$radio' ";
                }

                if( isset($_POST['sexo']) && !empty($_POST['sexo']) )    // SEXO
                {
                  if($contador == 1)
                    $consultaActulizarOpcionales.="," ;

                  $contador = 1;
                  $sexo =$_POST['sexo'];
                  $consultaActulizarOpcionales.=" SEXO = '$sexo' ";
                }

                $consultaActulizarOpcionales.=" WHERE ID_USUARIO = '$id_us' ";

                $db->query($consultaActulizarOpcionales);

            }
            else   // INSERTAR DATOS OPCIONALES
            {
                $consultaDatosOpcionales1="INSERT INTO DATOS_OPCIONALES_USUARIO (ID_USUARIO ";
                $consultaDatosOpcionales2="VALUE( '$id_us' ";

                 if( isset($_POST['telefono']) && !empty($_POST['telefono']) )    // FECHA DE NACIMIENTO
                {
                    $telefono =$_POST['telefono'];

                    $consultaDatosOpcionales1.=", TELEFONO ";
                    $consultaDatosOpcionales2.=", '$telefono' ";
                }

                if( isset($_POST['datepicker']) && !empty($_POST['datepicker']) )    // FECHA DE NACIMIENTO
                {
                    $fechaNacimiento=$_POST['datepicker'];
                    $consultaDatosOpcionales1.=", FECHA_NACIMIENTO ";
                    $consultaDatosOpcionales2.=", '$fechaNacimiento' ";
                }

                if( isset($_POST['geocomplete']) && !empty($_POST['geocomplete']) )    // LLENAR CIUDAD, LATITUD, LONGITUD
                {
                    $ciudad =$_POST['geocomplete'];
                    $latitud =$_POST['lat'];
                    $longitud =$_POST['lng'];

                    $consultaDatosOpcionales1.=", UBICACION, LATITUD, LONGITUD ";
                    $consultaDatosOpcionales2.=", '$ciudad', '$latitud', '$longitud' ";
                }

                if( isset($_POST['radio']) && !empty($_POST['radio']) )    // SEXO
                {
                    $radio =$_POST['radio'];

                    $consultaDatosOpcionales1.=", RADIO_BUSQUEDA_PARTIDOS ";
                    $consultaDatosOpcionales2.=", '$radio' ";
                }

                if( isset($_POST['sexo']) && !empty($_POST['sexo']) )    // SEXO
                {
                    $sexo =$_POST['sexo'];

                    $consultaDatosOpcionales1.=", SEXO ";
                    $consultaDatosOpcionales2.=", '$sexo' ";
                }

                $consultaDatosOpcionales1.=" ) ";
                $consultaDatosOpcionales2.=" ) ";

                $consultaFinal = $consultaDatosOpcionales1.$consultaDatosOpcionales2;

                $db->query($consultaFinal);

            }

            if($db->rows_affected > 0)
               $_SESSION['datosOpcionales']= "Se han modificado los datos opcionales";
            else
               $_SESSION['datosOpcionales']= "No se han modificado los datos opcionales";

            abrirPagina("./modificarPerfil.php",0);

		} ?>

	  </div>

      <div id="modificar-mapa" class="redondeado sombra">
        <div id="map_canvas" class="map_canvas"></div>
      </div>

      <div id="modificar-foto" class="redondeado sombra">

      <?

      if(isset($_SESSION['ImagenError']))
      {
        print "<label class='errorLogin'>".htmlentities($_SESSION['ImagenError'])."</label>";
        unset($_SESSION['ImagenError']);
      }

      if(isset($_SESSION['ImagenOk']))
      {
        print "<label class='ok'>".htmlentities($_SESSION['ImagenOk'])."</label>";
        unset($_SESSION['ImagenOk']);
      }

      if(!isset($_POST['modificarFoto']))
      {
      ?>
        <form id="formModificarFoto" name="formModificarFoto" method="POST" action="<? $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" >
    		<?
                $foto = $usuario->PATH_FOTO;

                if( $foto == "default.jpg" )
                    echo "<img src=./images/thumbnails/default.jpg  >";
                else
                    echo "<img src=./images/thumbnails/$foto >";
    		?>
    		<input id="foto" name="foto" type="file" placeholder="Foto de Perfil"/>

    		<input type="submit" name="modificarFoto" id="modificarFoto" value="Modificar" />
    	</form>
      <?
      }
      else
      {
             $consulta = "UPDATE USUARIO SET";

             /*  Para poner el nombre del archivo se utiliza la fecha y la hora de hoy como nombre y se le ponele
			su extension. Ademas se redimensiona la imagen para que sea menos pesada.*/

             // Si eligió la foto, se procece a trabajar con la foto.
			if(isset($_FILES["foto"]['name']) && !empty($_FILES["foto"]['name']) )
			{
				$hoy = date("Y-m-d H:i:s"); // Fecha
				$sNombreArchivo = strtotime($hoy); // Transformada en string
				//$sPath= realpath('./images/usuarios/').'\\'; // Path
				$sPath= './images/usuarios/'; // Path

				$sExtensionArchivo = pathinfo($_FILES["foto"]['name'], PATHINFO_EXTENSION); // Extension del archivo.
				$sNombreArchivo=$sNombreArchivo.".".$sExtensionArchivo; // nombre del archivo con extencion

				if( move_uploaded_file ($_FILES["foto"]['tmp_name'], $sPath.$sNombreArchivo) == FALSE) // no se pudo subir el archivo
				    echo "Error la subir la foto";

				$redim=redimensionar_imagen($sPath.$sNombreArchivo, $sNombreArchivo); // redimensiona la imagen

                //Borro la imagen anterior
                if($usuario->PATH_FOTO != "" && $usuario->PATH_FOTO != "default.jpg" && file_exists("./images/usuarios/".$usuario->PATH_FOTO))
                {
                  unlink("./images/usuarios/".$usuario->PATH_FOTO);
                  unlink("./images/thumbnails/".$usuario->PATH_FOTO);
                }
			}
			else // Si no eligió la foto
				$sNombreArchivo = "default.jpg";

            $consulta.= "  PATH_FOTO = '$sNombreArchivo' ";

            $consulta.=" WHERE ID = '$id_us'  ";

		//echo $consulta;

		$db->query($consulta);

            if($db->rows_affected > 0)
			    $_SESSION['ImagenOk']= "Se han modificado los datos correctamente.";
            else
                $_SESSION['ImagenError']= "No se han modificado los datos, intente mas tarde.";

            abrirPagina("./modificarPerfil.php",0);

      }
      ?>
      </div>

	</div>
    <? include("php/footer.php"); ?>
</div>

<? include("php/menu.php"); ?>
</body>
</html>