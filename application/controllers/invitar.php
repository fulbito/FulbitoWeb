<?
/*  Esta clase maneja:
 * 	- Index.
 *  - Muro ?
 *
 * */

class Invitar extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('partido_model');
		$this->load->model('usuario_model');
        $this->load->helper('form');
		$this->load->library('form_validation');
	}

	public function index()
	{
        $data['usuarios'] = $this->usuario_model->traer_usuarios();
    	$this->load->view('invitar/index', $data);
	}

}
?>
