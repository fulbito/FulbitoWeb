<?
/*
TODO: Grabar contraseña
Variables de sesion
Modificar foto
guardar Radio

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
<script language="javascript" type="text/javascript" src="./js/modificarPerfil.js"></script>

<!------------------------------------- MAPA ------------------------------------ http://ubilabs.github.io/geocomplete/  -->
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->
<script language="javascript" type="text/javascript" src="./js/ubilabs-geocomplete/jquery.geocomplete.js" ></script>
<script language="javascript" type="text/javascript" src="./js/ubilabs-geocomplete/jquery.geocomplete.min.js" ></script>
<script language="javascript" type="text/javascript" src="./js/mapa.js" ></script>

<!------------------------------------- FECHA ------------------------------------ http://jqueryui.com/datepicker/#dropdown-month-year  -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<!-- <script src="//code.jquery.com/jquery-1.9.1.js"></script> NO DESCOMENTAR TRAE INCOMPATIBILIDADES   -->
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

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
			<h1 style="margin-right:70px;">Modificar Perfil</h1>

<?php		if(!isset($_POST['modificar']))
		{
			$id = $_SESSION['id'];
			$usuario = $db->get_row("SELECT * FROM USUARIO WHERE ID = '$id' ");
			?>

			<form id="formModificar" name="formModificar" method="POST" action="<? $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

				<!----DATOS OBLIGATORIOS -->
				<input id="alias" name="alias" type="text" placeholder="Usuario" value="<? echo $usuario->ALIAS; ?>" /><br>
				<input id="email" name="email" type="text" placeholder="Correo eletronico" value="<? echo $usuario->MAIL; ?>" /><br>
				<input id="password" name="password" type="password" placeholder="Contrase&ntilde;a"/><br>
				<input id="confirma_password" name="confirma_password" type="password" placeholder="Confirmar Contrase&ntilde;a"/><br>

				<!----DATOS OPCIONALES -->
                <input id="telefono" name="telefono" type="text" placeholder="Celular o telefono"/><br>
                <input id="datepicker" name="datepicker" type="text" placeholder="Fecha de Nacimiento"/><br>
				<input type="radio" name="sexo" value="hombre" checked /> Hombre - <input type="radio" name="sexo" value="mujer" /> Mujer <br>
				<input id="geocomplete" name="geocomplete" type="text" placeholder="Type in an address" size="90" onchange="actualizar_mapa()"/><br>
				Rango de busqueda <input id="radio" name="radio" type="range" min="0" max="100" placeholder="Radio de busqueda en KM" size="90" onchange="actualizar_mapa()"/><br>

			    <input name="lat" id="lat" type="hidden" value="">
			    <input name="lng" id="lng" type="hidden" value="">

				<input type="submit" name="modificar" value="Modificar" />
			</form>

	<?		}
		else
		{
			$alias = $_POST['alias'];
			$email = $_POST['email'];

			$consulta = "UPDATE  USUARIO SET MAIL = '$email', ALIAS = '$alias' ";
			
			if(isset($_POST['password']) && !empty($_POST['password']) ) // Si cambio el password
			{
				$password = $_POST['password'];
				$consulta.= ", PASSWORD = '$password' ";
			}
			
			/*
			Para poner el nombre del archivo se utiliza la fecha y la hora de hoy como nombre y se le ponele
			su extension. Ademas se redimensiona la imagen para que sea menos pesada.
			*/

			if(isset($_FILES["foto"]['name']) && !empty($_FILES["foto"]['name']) ) // Si eligió la foto, se procece a trabajar con la foto.
			{
				$hoy = date("Y-m-d H:i:s"); // Fecha
				$sNombreArchivo = strtotime($hoy); // Transformada en string
				$sPath= realpath('./images/usuarios/').'\\'; // Path
				
				$sExtensionArchivo = pathinfo($_FILES["foto"]['name'], PATHINFO_EXTENSION); // Extension del archivo.
				$sNombreArchivo=$sNombreArchivo.".".$sExtensionArchivo; // nombre del archivo con extencion
				
				
				if( move_uploaded_file ($_FILES["foto"]['tmp_name'], $sPath.$sNombreArchivo) == FALSE) // no se pudo subir el archivo
				{
					echo "La imagen ".$sNombreArchivo." no ha sido cargada correctamente.";
				}
			   
				$redim=redimensionar_imagen($sPath.$sNombreArchivo, $sNombreArchivo); // redimensiona la imagen
				$consulta.= ", PATH_FOTO = '$sNombreArchivo' ";
			}
			else // Si no eligió la foto
			{
				$sNombreArchivo = "default.jpg";
			}
			
			$id_us = $_SESSION['id'];
			$consulta.=" WHERE ID = '$id_us'  ";

			$db->query($consulta);
			if($db->rows_affeted > 0) echo "Se ha modificado el perfil correctamente.<br>";


            //-------------- TRABAJA CON LOS DATOS OPCIONALES

           	$db->query("SELECT * FROM datos_opcionales_usuario WHERE ID_USUARIO = $id_us ");

            if($db->num_rows > 0) // ACTUALIZAR DATOS OPCIONALES
            {
               echo "Encontro el ID";

            }
            else      // INSERTAR DATOS OPCIONALES
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

                if($db->rows_affected)
                    echo "Se inserto correctamente";
         }


		} ?>

		</div>

      <div id="modificar-mapa" class="redondeado sombra">
        <div id="map_canvas" class="map_canvas"></div>
      </div>

      <div id="modificar-foto" class="redondeado sombra">
        <form id="formModificarFoto" name="formModificarFoto" method="POST" action="<? $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" >
    		<!----DATOS OPCIONALES -->
    		<? if( $usuario->PATH_FOTO == "default.jpg" )
    		   {
    		?>
    					<img src="./images/thumbnails/default.jpg" >
    		<?	}
    			else
    			{ ?>
    					<img src="./images/thumbnails/<? echo $usuario->PATH_FOTO; ?>" >
    		<?	}
    		?>
    		<input id="foto" name="foto" type="file" placeholder="Foto de Perfil"/>

    		<input type="submit" name="modificar" value="Modificar" />
    	</form>
      </div>

	</div>
    <? include("php/footer.php"); ?>
</div>

</body>
</html>