<?php
 
class Estado_partido extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');		
		$this->load->library('form_validation');
		$this->load->helper('general_helper'); // Tiene la funcion generar_string_aleatorio
                
                $this->load->library('grocery_CRUD');
                $this->load->database();
                $this->load->helper('url');

                $this->grocery_crud->set_language("spanish");
	}
   
	public function index()
	{	
            $this->grocery_crud->set_table('estado_partido');
            $this->grocery_crud->edit_fields('descripcion');
            $this->grocery_crud->add_fields('descripcion');

            $this->grocery_crud->set_theme('datatables');

            $this->grocery_crud->set_subject('Estado partido');
            $this->grocery_crud->required_fields('descripcion');
            $this->grocery_crud->columns('descripcion');

            $output = $this->grocery_crud->render();
            $this->estado_partido_output($output);
	}
        
        function estado_partido_output($output = null){
            $this->load->view('configuracion/viewABM',$output);
        } 
	
}
?>
