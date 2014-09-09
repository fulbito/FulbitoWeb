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
			$resultado = $this->Perfil_model->modificar_datos_perfil($_POST['alias'],$_POST['email'],$_POST['password']);
			//redirect(base_url()."index.php/perfil");
			
			/*
			$email_viejo = $this->Perfil_model->traer_email(); // trai
			
			if($email_viejo != $_POST['email'])
				$resultado = $this->Perfil_model->modificar_datos_perfil($_POST['alias'],$_POST['email'],$_POST['password']);
			else
				$resultado = $this->Perfil_model->modificar_datos_perfil($_POST['alias'],$_POST['email'],$_POST['password']);
			*/
			/*
			 * 
			$consulta = "UPDATE USUARIO SET MAIL = '$email', ALIAS = '$alias' ";

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
																								*/
			//-------------- TRABAJA CON LOS DATOS OPCIONALES ------------------------//
			/*
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

			abrirPagina("./modificarPerfil.php",0);*/
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
