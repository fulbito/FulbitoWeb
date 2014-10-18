<?

/*  Esta clase maneja:
 * 	- Mostrar usuario.
 *  - Modificar usuario
 * 	- Comprobar contraseña

/*	[ FALTA ] 
 *	- Hacer el uso de variables de SESIONES.
 * 	- En index: traer_datos_usuario enviando el email en session o el id, como queramos.
 * 	- Hacer la verificacion de variables de sesiones.
 * */
 
 
class Usuario extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_model');	
		$this->load->library('form_validation');
		$this->load->helper('general_helper'); // Tiene la funcion generar_string_aleatorio
		$this->load->helper(array('form', 'url'));
	}
	
	public function index()
	{	
		$id_usuario =  $this->session->userdata('id');
		$resultado = $this->Usuario_model->traer_datos_usuario($id_usuario);
		if ($resultado->num_rows() > 0)
		{
			$datos['datos_usuario'] = $resultado;
			$this->load->view('usuario/usuario',$datos);
		}
	}
	
	/* Modificar los datos obligatorios de usuario
	 * Modifica los datos opcionales de usuario.
	 * */
	public function modificar_datos_usuario()
	{
		chrome_log("usuario: modificar_datos_usuario");
		
		if(isset($_POST)) 
		{
			$id_usuario =  $this->session->userdata('id');
			chrome_log($id_usuario);
			
			$this->db->trans_start(); // INICIA UNA TRASACCION
			
			$this->Usuario_model->modificar_datos_obligatorios($_POST); // Alias, email, password
			$this->Usuario_model->modificar_datos_opcionales($_POST); // telefono, fecha nacimiento, sexo
		
			$this->db->trans_complete();
			
			
			if ($this->db->trans_status() === FALSE)
			{
				chrome_log("eRROR");
				$datos['mensaje_error'] = "No se ha podido modificar los datos, intente mas tarde.";
				
				// WS
				$return["error"] = TRUE;
				$return["data"] = 9 ;
				$this->load->view('login/login',$datos);
			}
			else
			{
				chrome_log("EXITO");
				$datos['mensaje_exito'] = "Datos modificados correctamente.";
				$return["error"] = FALSE;

				$resultado = $this->Usuario_model->traer_datos_usuario($id_usuario);
				if ($resultado->num_rows() > 0)
				{
					$datos['datos_usuario'] = $resultado;
					$this->load->view('usuario/usuario',$datos);
				}
			} 
			
			if( isset($_POST['origen']) && ($_POST['origen']=="android") )
			{
				crear_json($return);
			}

		}
		else
		{
			chrome_log("NO SETEO");
			
			if( isset($_POST['origen']) && ($_POST['origen']=="android") )
			{
				// WS
				$return["error"] = TRUE;
				$return["data"] = 8; //Debe enviar los datos a modificar
				crear_json($return);
			}
			else
				redirect(base_url()."index.php/home");
		}	
	}
	
	
	/* Modifica la foto de usuario del usuario
	 * - Sube la foto al servidor
	 * - Hace un resize para la web y otro para android
	 * - Borra la imagen del servidor
	 * 														 */
	 
	function modificar_foto_perfil() 
	{
		chrome_log("usuario: modificar_foto_usuario");
		$id_usuario =  $this->session->userdata('id');
		/* GUARDAR LA FOTO EN EL SERVIDOR */

		$this->load->helper('form');

		//Configure
		$config['upload_path'] = 'assets/images/fotos_usuario/'; // Carpeta donde guarda las fotos
		$config['allowed_types'] = 'gif|jpg|png'; 	// set the filter image types
		$nombre_archivo = $id_usuario."_".time();
		$config['file_name'] = $nombre_archivo; // Nombre en el servidor

		//load the upload library
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->set_allowed_types('*');
		
		if (!$this->upload->do_upload('userfile')) //---------------- NO subio la foto al servidor
		{
			chrome_log("usuario: NO subio la foto al servidor");
			//echo $this->upload->display_errors();
			$mensaje_error = "No se ha podido subir la foto, intente mas tarde.";
			$datos['mensaje_foto_error'] =$mensaje_error;
			$return["error"] = TRUE;
			$return["data"] = $mensaje_error;
			$resultado = $this->Usuario_model->traer_datos_usuario($id_usuario);
			if ($resultado->num_rows() > 0)
			{
				$datos['datos_usuario'] = $resultado;
				$this->load->view('usuario/usuario',$datos);
			}	
		} 
		else  //---------------- SI subio la foto original
		{ 
			chrome_log("usuario: SI subio la foto original");
			$data = array('msg' => "Upload success!");
			$datos= $this->upload->data();	// Trae informacion de la foto subida.
			$nombre_archivo = $datos['file_name'];
					
			//---- Genero la imagen WEB
			$config_web['image_library'] = 'gd2';
			$config_web['source_image']	= 'assets/images/fotos_usuario/'.$nombre_archivo;
			$config_web['new_image'] = 'assets/images/fotos_usuario/foto_web/'.$nombre_archivo;
			$config_web['width']	= 200;
			$config_web['height']	= 225;
				
			$this->load->library('image_lib');
			$this->image_lib->initialize($config_web);
				
			if ( ! $this->image_lib->resize()) //---------------- NO pudo modificar la foto WEB
			{
				// echo "Imagen Web: ".$this->image_lib->display_errors();
				chrome_log("usuario:  NO pudo modificar la foto WEB");
								
				// Borrar foto original
				$ruta_archivo = 'assets/images/fotos_usuario/'.$nombre_archivo;
				borrar_foto_usuario($ruta_archivo);
				
				$mensaje_error = "No se ha podido subir la foto, intente mas tarde.";
				$datos['mensaje_foto_error'] =$mensaje_error;
				$return["error"] = TRUE;
				$return["data"] = $mensaje_error;
				$resultado = $this->Usuario_model->traer_datos_usuario($id_usuario);
				if ($resultado->num_rows() > 0)
				{
					$datos['datos_usuario'] = $resultado;
					$this->load->view('usuario/usuario',$datos);
				}	
			}
			else //---------------- SI Modifico la foto WEB
			{
				chrome_log("usuario:  SI Modifico la foto WEB");
				//---- Genero la imagen ANDROID
				$config_android['image_library'] = 'gd2';
				$config_android['source_image']	= 'assets/images/fotos_usuario/'.$nombre_archivo;
				$config_android['new_image'] = 'assets/images/fotos_usuario/foto_android/'.$nombre_archivo;
				$config_android['width']	= 50;
				$config_android['height']	= 75;
					
				$this->load->library('image_lib');
				$this->image_lib->initialize($config_android);
					
				if ( ! $this->image_lib->resize()) //---------------- NO pudo modificar la foto ANDROID
				{
					// echo "Imagen ANDROID: ".$this->image_lib->display_errors();
					$ruta_archivo = 'assets/images/fotos_usuario/'.$nombre_archivo;
					borrar_foto_usuario($ruta_archivo);
					
					$ruta_archivo = 'assets/images/fotos_usuario/foto_web/'.$nombre_archivo;
					borrar_foto_usuario($ruta_archivo);
					
					$mensaje_error = "No se ha podido subir la foto, intente mas tarde.";
					$datos['mensaje_foto_error'] =$mensaje_error;
					$return["error"] = TRUE;
					$return["data"] = $mensaje_error;
					$resultado = $this->Usuario_model->traer_datos_usuario($id_usuario);
					if ($resultado->num_rows() > 0)
					{
						$datos['datos_usuario'] = $resultado;
						$this->load->view('usuario/usuario',$datos);
					}	
				}
				else  //---------------- SI Modifico la foto ANDROID -----------------
				{
					$nombre_foto_anterior = $this->Usuario_model->traer_nombre_foto($id_usuario);
					$resultado = $this->Usuario_model->actualizar_nombre_foto($nombre_archivo);				
					
					if($resultado) // Si modifico el nombre
					{
						if($nombre_foto_anterior != 'default.jpg') 
						{
							$ruta_archivo = 'assets/images/fotos_usuario/'.$nombre_archivo;
							borrar_foto_usuario($ruta_archivo);
							
							$ruta_archivo = 'assets/images/fotos_usuario/foto_android/'.$nombre_foto_anterior;
							borrar_foto_usuario($ruta_archivo);
							
							$ruta_archivo = 'assets/images/fotos_usuario/foto_web/'.$nombre_foto_anterior;
							borrar_foto_usuario($ruta_archivo);
						}
						
						$mensaje_exito = "La foto se ha modificado exitosamente.";
						$datos['mensaje_foto_exito'] =$mensaje_exito;
						$return["error"] = FALSE;
						$return["data"] = $mensaje_exito;
						$resultado = $this->Usuario_model->traer_datos_usuario($id_usuario);
						if ($resultado->num_rows() > 0)
						{
							$datos['datos_usuario'] = $resultado;
							$this->load->view('usuario/usuario',$datos);
						}	
					}
					else // Si no actualizo el nombre, borro el original, android y web de la foto nueva.
					{	
						$ruta_archivo = 'assets/images/fotos_usuario/'.$nombre_archivo;
						borrar_foto_usuario($ruta_archivo);
						
						$ruta_archivo = 'assets/images/fotos_usuario/foto_android/'.$nombre_archivo;
						borrar_foto_usuario($ruta_archivo);
						
						$ruta_archivo = 'assets/images/fotos_usuario/foto_web/'.$nombre_archivo;
						borrar_foto_usuario($ruta_archivo);			
						
						$mensaje_error = "No se ha podido subir la foto, intente mas tarde.";
						$datos['mensaje_foto_error'] =$mensaje_error;
						$return["error"] = TRUE;
						$return["data"] = $mensaje_error;
						$resultado = $this->Usuario_model->traer_datos_usuario($id_usuario);
						if ($resultado->num_rows() > 0)
						{
							$datos['datos_usuario'] = $resultado;
							$this->load->view('usuario/usuario',$datos);
						}	
					}					
					
				}			
			}
			
			crear_json($return);
		}
	}
	
	/* Comprueba que al cambiar el email no haya otro igual.
	 * */
	public function comprobar_email_existente()
	{
		chrome_log("comprobar_email_existente");
		$correo = $_POST['email'];
		
		$resultado = $this->Usuario_model->existeCorreoDuplicado($correo); 
						
		if($resultado) 
		{
			echo "false"; 
		}
		else // Duplicado
		{
			echo "true"; 
		}
	}
	

}
?>
