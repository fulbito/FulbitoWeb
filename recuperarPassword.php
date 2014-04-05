<?php

/*
Genera un nuevo password enviandolo por email. 
Antes de actualizar el password, guardamos el password viejo para restaurarlo en el caso que no se pueda enviar
por email.
Tiene un problema al laburar en localhost, entonces para que funcione, hay que usarlo en el servidor.

*/

include_once("php/sesion.php");

//header("Content-type: text/xml"); // No puedo poner echo despues de esta funcion por que me arruina el xml (averiguar)


// Conexion de la BD
include_once "./php/clases/ezSQL-master/shared/ez_sql_core.php"; // Include ezSQL core (BD)
include_once "./php/clases/ezSQL-master/mysql/ez_sql_mysql.php"; // Include ezSQL mysql
include_once "./php/conexionBD.php";

include_once "./php/funciones/funcionesGenerales.php";
include_once "./php/clases/PHPMailer-master/class.phpmailer.php"; // Mail
include_once "./php/clases/PHPMailer-master/class.smtp.php";

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
<script language="javascript" type="text/javascript" src="./js/recuperarPassword.js"></script>
<body>

<div id="wrapper">
    <div id="degrade_arriba"></div>
    <div id="degrade_abajo"></div>
    <div id="maincontent">

      <header>

          <a href="index.php"><img src="images/logo.png" alt="Fulbito" /></a>

      </header>
		
		<?php
		if(!isset($_POST['enviar']))
		{ ?>
			<div id="login" class="redondeado sombra">

					  <h1 style="margin-right:70px;">Recuperar password</h1>

						<form id="formRecuperar" name="formRecuperar" method="post" action="<? $_SERVER['PHP_SELF']; ?>"  >
							<input id="email" name="email" type="text" placeholder="Correo eletronico"/><br>
							<input type="submit" id="enviar" name="enviar" value="Enviar" >
						</form>
		   </div>		
<?php	} 
		else
		{ 
		   $correo = $_POST['email'];
		   //echo $correo ;
			$url="./index.php";
			$tiempo='0';
		   
			$codigo = RandomString(10); // Genera el nuevo password
			$codigoCodificado = md5($codigo);
			
			include_once "./php/clases/ezSQL-master/shared/ez_sql_core.php"; // Include ezSQL core (BD)
			include_once "./php/clases/ezSQL-master/mysql/ez_sql_mysql.php"; // Include ezSQL mysql

			// Conexion de la BD

			include_once "./php/conexionBD.php";
			global $db;
			
			// Recupero el password primero, por si tengo que restaurarlo
			
			$passwordAnterior = $db->get_var("SELECT PASSWORD FROM USUARIO WHERE MAIL = '$correo'");
			echo "anterior ".$passwordAnterior;
			
			// Actualiza el password
			$db->query("UPDATE USUARIO SET PASSWORD = '$codigoCodificado' WHERE MAIL = '$correo'"); // ACTUALIZO EL PASSWORD
			//$db->debug();
			
			if($db->rows_affected > 0) //  Si se actualizo el password
			{
				//Especificamos los datos y configuración del servidor
				$mail = new PHPMailer();
				 
				//Agregamos la información que el correo requiere
				$mail->From = "fulbitoweb@gmail.com";
				$mail->FromName = "Fulbitoweb";
				$mail->Subject = "Enviar Mail con PHPMailer";
				$body = "<h1>Su nuevos password es:</h1><br/>
							Clave: $codigo <br/>
							<h1>Recuerde cambiar su password.</h1><br/>";
				$mail->MsgHTML($body);
				$mail->AddAddress($correo , "Usuario Prueba");
				$mail->IsHTML(true);
				 
				//Enviamos el correo electrónico
				if($mail->Send())
				{
					//Sacamos un mensaje de que todo ha ido correctamente.
               $_SESSION['ok'] = "Se ha enviado un mail con su nueva clave.";
					abrirPagina($url,$tiempo);
				}
				else{
					//Sacamos un mensaje con el error.
					$_SESSION['error'] = "Ocurrió un error al actualizar su clave, intente mas tarde.";
					
					// Restauro el password anterior
					$db->query("UPDATE USUARIO SET PASSWORD = '$passwordAnterior' WHERE MAIL = '$correo'"); 
					//$db->debug();
					
					abrirPagina($url,$tiempo);	
				}
			}
			else{ // No funcinoa la BD
			
				$_SESSION['error'] = "No se pudo actualizar el password, intente mas tarde";
				// vuelvo al index
				abrirPagina($url,$tiempo);				
			}

		}
		
		?>
    </div>

    <? include("php/footer.php"); ?>

</div>



</body>

</html>