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
		//$this->load->model('usuario_model');
		$this->load->model('invitar_model');
        $this->load->helper('form');
		$this->load->library('form_validation');
	}

	public function index()
	{
	    $id_partido = $this->uri->segment(3);

        if(isset($id_partido))
        {
            $data['partido'] = $this->partido_model->traer_informacion_partido($id_partido);
            $data['usuarios'] = $this->invitar_model->traer_usuarios_no_invitados($id_partido);
            $data['amigos'] = $this->invitar_model->traer_amigos_no_invitados($this->session->userdata('id'), $id_partido);
            $data['invitados'] = $this->invitar_model->traer_invitados($id_partido);
    	    $this->load->view('invitar/index', $data);
        }
	}

    public function ajax_invitar()
	{
	    if( isset($_POST['id_usuario']) && isset($_POST['id_partido']) )
        {
            $id_usuario = $_POST['id_usuario'];
            $id_partido = $_POST['id_partido'];
            $id_estado = 1;
            $id_tipo_adhesion = 1;
            $fecha_adhesion = 0;

    	    $resultado = $this->invitar_model->guardar_invitado($id_partido, $id_usuario, $id_estado, $id_tipo_adhesion, $fecha_adhesion);
    		if ( $resultado > 0 )
    		{
    			$aux["id"] = $resultado;
    			$return["error"] = FALSE;
    			$return["data"] = $aux;
    		}
    		else
    		{
    			$return["error"] = TRUE;
    			$return["data"] = "Error BD";
    		}
        }
        else
        {
          $return["error"] = TRUE;
          $return["data"] = "Debe completar todos los datos.";
        }

        crear_json($return);
	}

}
?>
