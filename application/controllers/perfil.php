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
		$this->load->helper(array('form', 'url'));
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
	 * */
	public function modificar_datos_perfil()
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
	
	
	/* Modifica la foto de perfil del usuario
	 * - Sube la foto al servidor
	 * - Hace un resize para la web y otro para android
	 * - Borra la imagen del servidor
	 *  */
	 
	function modificar_foto_perfil() 
	{
		$id_usuario =  $this->session->userdata('id');
				
		/* GUARDAR LA FOTO EN EL SERVIDOR */
		 
		//load the helper
		$this->load->helper('form');

		//Configure
		$config['upload_path'] = 'assets/images/fotos_perfil'; // Carpeta donde guarda las fotos
		$config['allowed_types'] = 'gif|jpg|png'; 	// set the filter image types
		$nombre_archivo = $id_usuario."_".time();
		$config['file_name'] = $nombre_archivo; // Nombre en el servidor

		//load the upload library
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->set_allowed_types('*');
		
		if (!$this->upload->do_upload('userfile')) // No subio la foto
		{
			//echo $this->upload->display_errors();
			//$data = array('msg' => $this->upload->display_errors());
			$mensaje_error = "No se ha podido modificar subir la foto, intente mas tarde.";
			$datos['mensaje_error'] =$mensaje_error;
			$this->load->view('perfil/perfil',$datos);
			
		} 
		else  // Subio la foto
		{ 
			$data = array('msg' => "Upload success!");
			$datos= $this->upload->data();
			$nombre_archivo = $datos['file_name'];
					
			//---- Genero la imagen WEB
			$config_web['image_library'] = 'gd2';
			$config_web['source_image']	= 'assets/images/fotos_perfil/'.$nombre_archivo;
			$config_web['new_image'] = 'assets/images/fotos_perfil/foto_web/'.$nombre_archivo;
			$config_web['width']	= 200;
			$config_web['height']	= 225;
				
			$this->load->library('image_lib');
			$this->image_lib->initialize($config_web);
				
			if ( ! $this->image_lib->resize())
			{
				//echo "Imagen Web: ".$this->image_lib->display_errors();
				//echo $this->upload->display_errors();
				$mensaje_error = "No se ha podido modificar la imagen web, intente mas tarde.";
				$datos['mensaje_error'] =$mensaje_error;
				$this->load->view('perfil/perfil',$datos);
			}
			
			//---- Genero la imagen ANDROID
			$config_android['image_library'] = 'gd2';
			$config_android['source_image']	= 'assets/images/fotos_perfil/'.$nombre_archivo;
			$config_android['new_image'] = 'assets/images/fotos_perfil/foto_android/'.$nombre_archivo;
			$config_android['width']	= 50;
			$config_android['height']	= 75;
				
			$this->load->library('image_lib');
			$this->image_lib->initialize($config_android);
				
			if ( ! $this->image_lib->resize())
			{
				//echo "Imagen Web: ".$this->image_lib->display_errors();
				$mensaje_error = "No se ha podido modificar la imagen android, intente mas tarde.";
				$datos['mensaje_error'] =$mensaje_error;
				$this->load->view('perfil/perfil',$datos);
			}
			
			//---- Borro la imagen del servidor y borrar imagen anterior ----//
			
			$file = 'assets/images/fotos_perfil/'.$nombre_archivo;
			$do = unlink($file);
			 
			if($do != true){
				echo "ERROR AL BORRAR EL ARCHIVO<br />";
			}
			else
			{
				echo "Borrer el archivo";
			}
			

		}
		
		
		

		//load the view/upload.php
		//$this->load->view('upload', $data);

	}
	 
	 /*
	public function modificar_foto_perfil()
	{
		echo base_url()."<br>";
		
		if(isset($_POST['modificarFoto']))
		{
			//load the helper
			$this->load->helper('form');
			//Configure
			//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
			$config['upload_path'] = 'application/views/uploads/';

			// set the filter image types
			$config['allowed_types'] = 'gif|jpg|png';

			//load the upload library
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->set_allowed_types('*');

			$data['upload_data'] = '';

			//if not successful, set the error message
			if (!$this->upload->do_upload('userfile')) 
			{
				$data = array('msg' => $this->upload->display_errors());
				echo "error 2";
			} 
			else 
			{ //else, set the success message
				$data = array('msg' => "Upload success!");
				$data['upload_data'] = $this->upload->data();
				echo "exito";
			}
		}	
	} */
	
	
	/* Comprueba que al cambiar el email no haya otro igual.
	 * */
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
