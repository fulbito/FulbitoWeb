<?
/*  Esta clase maneja:
 * 	- Logueo.
 *  - Registracion.
 * 	- Recuperacion de contraseña.
 * 
 * */

/*	[ FALTA ] 
 *	- Hacer el uso de variables de SESIONES (Pensar si la vamos a guardar en la BD la session, algunos lo recomiendan)
 * 	- Hacer el Logout.
 * 	- Hacer la verificacion de variables de sesiones.
 * */
 
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');		
		$this->load->library('form_validation');
		$this->load->helper('general_helper'); // Tiene la funcion generar_string_aleatorio
	}
	
	/* INGRESAR:
	 * Busca si existe el correo y el password y devuelve la fila.
	 * Armael JSON para devolverlo en el ajax
	 * Si recibe un 1 es error y lo muestra en en login.
	 * */
	
	public function index()
	{	
		chrome_log("logueo");
		$this->load->view('login/login');
	}
	
	
	public function ingresar()
	{
		chrome_log("ingresar");

		if( isset($_POST['correo']) && !empty($_POST['correo']) &&
			isset($_POST['clave']) && !empty($_POST['clave']) )
		{
			chrome_log("POST");
			chrome_log($_POST['correo']);
			chrome_log($_POST['clave']);
			$resultado = $this->Login_model->loguearse($_POST['correo'],$_POST['clave']); //pasamos los valores al modelo para que compruebe si existe el usuario con ese password

			if ($resultado->num_rows() > 0)
			{
    			chrome_log("CORRECTO");

				foreach ($resultado->result() as $row)
				{
                	chrome_log($row->alias);
					
					$this->session->set_userdata('id', $row->id);
					$this->session->set_userdata('mail', $row->email);
					
					$aux['id'] = $row->id;
					$aux['alias'] = $row->alias;
					$aux['mail'] = $row->email;
					
					$aux['fecha_nacimiento'] = $row->fecha_nacimiento;
					$aux['ubicacion'] = $row->ubicacion;
					$aux['longitud'] = $row->longitud;
					$aux['sexo'] = $row->sexo;
					$aux['telefono'] = $row->telefono;
					$aux['radio_busqueda_partido'] = $row->radio_busqueda_partido;
					
					// WS
					$return["error"] = FALSE;
					$return["data"] = $aux;
				}
			}
			else
			{
				// WS
				$return["error"] = TRUE;
				$return["data"] = 2; // 2: Email o Contraseña incorrectos.
				
			}

			crear_json($return);

		}
		else
		{
			chrome_log("NO SETEO");
			
			if( isset($_POST['origen']) && ($_POST['origen']=="android") )
			{
				// WS
				$return["error"] = TRUE;
				$return["data"] = 1; 
				crear_json($return);
			}
			else
				redirect(base_url()."index.php/login");
			
		}

	}

	/* ERROR USUARIO O CLAVE INCORRECTOS
	 * Se llama cuando no coinciden email y password.
	 * 												*/
	public function error_ingresar()
	{
		$mensaje_error = "Usuario o Password incorrecto.";
		$datos['mensaje_error'] =$mensaje_error;
		$this->load->view('login/login',$datos);
	}

	/* REGISTRAR:
	* Busca si existe el correo y el password y devuelve la fila.
	* Armael JSON para devolverlo en el ajax
	* Si recibe un 1 es error y lo muestra en en login.
	* 														*/
	
	public function registrar_usuario()
	{
		if( isset($_POST['alias']) && !empty($_POST['alias']) &&
			isset($_POST['email']) && !empty($_POST['email']) &&
			isset($_POST['password']) && !empty($_POST['password']) )
		{
			chrome_log("registrar_usuario");
			$alias= $_POST['alias'];
			$email= $_POST['email'];
			
			$resultado_email = $this->Login_model->existeCorreo($_POST['email']); 
								
			if(!$resultado_email) 
			{
				chrome_log("FUNCION : resultado_email");
				$password= md5($_POST['password']);
				$resultado = $this->Login_model->registrarse($_POST['alias'],$_POST['email'],$password);

				if ( $resultado > 0)
				{
					$this->session->set_userdata('id', $this->db->insert_id());
					$this->session->set_userdata('mail', $_POST['email']);
					
					chrome_log("POSITIVO");
					// WS
					$aux["id"] = $this->db->insert_id();
					$return["error"] = FALSE;
					$return["data"] = $aux;
					
				}
				else
				{
					chrome_log("NEGATIVO");
					// WS
					$return["error"] = TRUE;
					$return["data"] = 5; // 5: No se ha podido registrar al usuario, intente nuevamente mas tarde.
					
				}
			}
			else // Duplicado
			{
				chrome_log("DUPLICADO");
				// WS
				$return["error"] = TRUE;
				$return["data"] = 4; // 4: Email duplicado, ya existe un usuario con ese email registrado.
			}
			
			crear_json($return);
				
		}
        else
        {
            chrome_log("NO SETEO REGISTRARSE");
			
			if( isset($_POST['origen']) && ($_POST['origen']=="android") )
			{
				// WS 
				$return["error"] = TRUE;
				$return["data"] = 3;	// 3: Debe completar todos los campos.
				crear_json($return);
			}
			else
				redirect(base_url()."index.php/login");
        }
	
	}
	
	/* ERROR AL REGISTRAR EL USUARIO
	 * Se llama cuando no coinciden email y password.
	 * 												*/
	public function error_registrar_usuario()
	{
		$mensaje_error = "No se ha podido registrar al usuario, intente mas tarde.";
		$datos['mensaje_error'] =$mensaje_error;
		$this->load->view('login/login',$datos);	
	}
	
	/* RECUPERAR PASSWORD:
	 * Busca si existe el correo, si existe le envia un password generado aleatoriamente.
	 * Se guarda le password viejo por si hay un error durante el cambio.
	 * Se envia un email con la nueva clave, pidiendole que la cambie	 *
	 * 
	 * 
	 * */
	public function recuperar_password()
	{
		chrome_log("recuperar_password");
				
		if(!isset($_POST['email']))
		{ 
			if( isset($_POST['origen']) && ($_POST['origen']=="android") )
			{ 
				// WS
				$return["error"] = TRUE;
				$return["data"] = 6; // 6: debe ingresar su email registrado para recuperar su contraseña.
				crear_json($return);
			}
			else
				$this->load->view('login/recuperar_password');
		}
		else
		{
			chrome_log("Enviar password");
			$this->load->library('email');

			$correo = $_POST['email'];
		    		   
			$codigo = generar_string_aleatorio(10); // Genera el nuevo password
			$codigoCodificado = md5($codigo);
						
			$password_viejo =  $this->Login_model->guardarPasswordViejo($correo); // Guardo el viejo password por si hay que restaurarlo
			$resultado = $this->Login_model->cambiar_password($codigoCodificado,$correo);
						
			if($resultado)
			{
				chrome_log("Cambio exitoso");
				
				// Envio el email con el codigo
				date_default_timezone_set('America/New_York');
				$this->load->library('email','','correo');

				$this->correo->from('fulbitoweb@gmail.com', 'Fulbito Web');
				$this->correo->to($correo);
				$this->correo->subject('This is an email test');
				$this->correo->message("<h1>Su nuevos password es:</h1><br/>
										Clave: ".$codigo."<br/>
										<h1>Recuerde cambiar su password.</h1><br/>");
				
				if($this->correo->send())
				{
					$mensaje_exito = "Se ha enviado un mail con su nueva clave.";
					$datos['mensaje_exito'] =$mensaje_exito;
										
					// WS
					$return["error"] = FALSE;
					$return["data"] = $mensaje_exito;
				}
				else
				{
					show_error($this->correo->print_debugger());
					$datos['mensaje_error'] = "Ocurrió un error al actualizar su clave, intente mas tarde.";
					
					// Web Service
					$return["error"] = TRUE;
					$return["data"] = 7; 	// 7: Ocurrió un error al actualizar su clave, intente mas tarde.
				
					// Restauro el password viejo
					$resultado = $this->Login_model->cambiar_password($password_viejo,$correo);
					
					if($resultado) // 
						chrome_log("Password restaurado");
					else
						chrome_log("No se pudo restaurar el password");
				}
				
			}
			else // No se pudo cambiar el password 
			{
				chrome_log("Cambio erroneo");
				$resultado = $this->Login_model->cambiar_password($password_viejo,$correo); // Restauro password viejo.
				
				if($resultado) // si existe el usuario, registramos las variables de sesión y abrimos la página de exito
					chrome_log("Password restaurado");
				else
					chrome_log("No se pudo restaurar el password");
					
				$datos['mensaje_error'] = "Ocurrió un error al actualizar su clave, intentelo nuevalemnte mas tarde.";
				
				// Web Service
				$return["error"] = TRUE;
				$return["data"] = 7 ;
			}
			
			if( isset($_POST['origen']) && ($_POST['origen']=="android") )
			{
				crear_json($return);
			}
			else
				$this->load->view('login/login',$datos);
			
			
		}
	}
   
    /* COMPROBACIONES AJAX.
     * Se utiliza para realizar las comparaciones de emails.
     * - Al registrarse, para comprobar que no haya otro usuario con ese mail.
     * - Al recuperar la contraseña, que exista ese email para poder enviar la clave.
     * 
     * */
    
    //---------------------- Registrarse  --------------------------//
    public function comprobar_email_existente()
	{
		chrome_log("comprobar");
		$correo = $_POST['email'];
		
		$resultado = $this->Login_model->existeCorreo($correo); 
						
		if($resultado) 
		{
			echo "false"; 
		}
		else // Duplicado
		{
			echo "true"; 
		}
	}
	
	//---------------------- Comprobar que no existe el email  --------------------------//
	public function comprobar_email_no_existente()
	{
		chrome_log("comprobar");
		$correo = $_POST['email'];
		
		$resultado = $this->Login_model->existeCorreo($correo); 
						
		if($resultado) 
		{
			echo "true"; 
		}
		else // Duplicado
		{
			echo "false"; 
		}
	}
  
    public function logout()
    {
    	$this->session->unset_userdata('id');
        $this->session->sess_destroy();
        $this->load->view('login/login');
    }

  /*
	public function data()
	{
		if($this->session->userdata['username'] == TRUE)
		{
		echo $this->session->userdata['username'];
		echo " ";
		echo $this->session->userdata['password'];
		}
	}
   
	public function destroy()
	{
		//destruimos la sesión
		$this->login_model->close();
 
		echo "Sesión borrada"."";
	}
   
	public function perfil()
	{
		//pagina restringida a usuarios registrados.
		$logged = $this->login_model->isLogged();
	   
		if($logged == TRUE)
		{
			echo "Tienes permiso para ver el contenido privado";
		}
		else
		{
			//si no tiene permiso, abrimos el formulario para loguearse
			$this->load->view('login');
		}
	} */

}
?>
