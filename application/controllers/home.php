<?
/*  Esta clase maneja:
 * 	- Index.
 *  - Muro ?
 * 
 * */
 
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');		
		$this->load->library('form_validation');
		$this->load->helper('general_helper'); // Tiene la funcion generar_string_aleatorio
	}
   
	public function index()
	{	
			chrome_log("logueo");
			$this->load->view('home/home');
			$this->load->view('home/menu');
			
	}
	

}
?>
