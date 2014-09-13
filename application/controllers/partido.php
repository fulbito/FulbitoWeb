<?
/*  Esta clase maneja:
 * 	- Index.
 *  - Muro ?
 * 
 * */
 
class Partido extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('partido_model');
        $this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('general_helper'); // Tiene la funcion generar_string_aleatorio
	}
   
	public function index()
	{
    	$this->load->view('partido/home');
	}

    public function crear()
	{
	    $data['error'] = "";

        $this->form_validation->set_rules('nombre', 'nombre', 'required');
    	$this->form_validation->set_rules('fecha', 'fecha', 'required');
    	$this->form_validation->set_rules('hora', 'hora', 'required');
    	$this->form_validation->set_rules('cancha', 'cancha', 'required');

        if ($this->form_validation->run() === FALSE)
    	{
    		$this->load->view('partido/crear', $data);
    	}
    	else
    	{
    		$partido_id = $this->partido_model->crear();
            if($partido_id)
            {
              $data['partido_id'] = $partido_id;
              $this->load->view('partido/armar', $data);
            }
            else
            {
              $data['error'] = "Se produjo un error al crear el partido";
              $this->load->view('partido/crear', $data);
            }
    	}
	}

    public function armar()
	{
	    $data['error'] = "";

        if ($this->form_validation->run() === FALSE)
    	{
    		$this->load->view('partido/armar', $data);
    	}
    	else
    	{
    		$partido_id = $this->partido_model->crear();
            if($partido_id)
            {
              $data['partido_id'] = $partido_id;
              $this->load->view('partido/final', $data);
            }
            else
            {
              $data['error'] = "Se produjo un error al crear el partido";
              $this->load->view('partido/armar', $data);
            }
    	}
	}

}
?>
