<!DOCTYPE html>
<html>

<? $this->load->view('templates/head'); ?>

<body>

<div id="wrapper">
    <div id="degrade_arriba"></div>
    <div id="degrade_abajo"></div>
    <div id="maincontent">

    <? $this->load->view('templates/header'); ?> 
	<?php
	/*
		if(!isset($_POST['enviar']))
		{*/ ?>
			
			<div id="login" class="redondeado sombra">

					  <h1 style="margin-right:70px;">Recuperar password</h1>

						<form id="formRecuperar" name="formRecuperar" method="post" action="<? $_SERVER['PHP_SELF']; ?>"  >
							<input id="email" name="email" type="text" placeholder="Correo eletronico"/><br>
							<input type="submit" id="enviar" name="enviar" value="Enviar" >
						</form>
			</div>		
<?php	/*} 
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
		*/
		?>
    </div>

    <?// include("php/footer.php"); ?>

</div>



</body>

</html>
