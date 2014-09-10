<?

/*  Esta clase maneja:
 * 	- Mostrar Perfil.
 *  - Modificar Perfil
 * 	- Comprobar contraseña
 * */

/*	[ FALTA ] 
 *	- Hacer el uso de variables de SESIONES.
 * 	- En index: traer_datos_perfil enviando el email en session o el id, como queramos.
 * 	- Hacer la verificacion de variables de sesiones.
 * */
 
 
class Perfil extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Perfil_model');	
		$this->load->library('form_validation');
		$this->load->helper('general_helper'); // Tiene la funcion generar_string_aleatorio
	}
	
	public function index()
	{	
		$resultado = $this->Perfil_model->traer_datos_perfil();
		if ($resultado->num_rows() > 0)
		{
			$datos['datos_perfil'] = $resultado;
			$this->load->view('perfil/perfil',$datos);
		}
		
		
	}
	
	/* Modificar los datos obligatorios de usuario
	 * Modifica los datos opcionales de usuario.
	 * 
	 * */
	public function modificar_perfil()
	{
		if(isset($_POST['modificar']))
		{
		
			$this->db->trans_start(); // INICIA UNA TRASACCION
			
			$resultado = $this->Perfil_model->modificar_datos_obligatorios($_POST); // Alias, email, password
			$resultado = $this->Perfil_model->modificar_datos_opcionales($_POST); // telefono, fecha nacimiento, sexo
		
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{
				$mensaje_error = "No se ha podido modificar los datos, intente mas tarde.";
				$datos['mensaje_error'] =$mensaje_error;
				$this->load->view('login/login',$datos);
			}
			else
			{
				$mensaje_exito = "Datos modificados correctamente.";
				$datos['mensaje_exito'] =$mensaje_exito;
				$resultado = $this->Perfil_model->traer_datos_perfil();
				if ($resultado->num_rows() > 0)
				{
					$datos['datos_perfil'] = $resultado;
					$this->load->view('perfil/perfil',$datos);
				}
			}
			
		}
		else
		{
			redirect(base_url()."index.php/home");
		}	
	}
	
	public function comprobar_email_existente()
	{
		chrome_log("comprobar_email_existente");
		$correo = $_POST['email'];
		
		$resultado = $this->Perfil_model->existeCorreoDuplicado($correo); 
						
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
