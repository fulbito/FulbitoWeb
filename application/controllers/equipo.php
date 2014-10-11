<?
/*  Esta clase maneja:
 * 	- Index.
 *  - Muro ?
 * 
 * */
 
class Equipo extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('partido_model');
		$this->load->model('usuario_model');
		$this->load->model('invitar_model');
        $this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('general_helper'); // Tiene la funcion generar_string_aleatorio
	}
   
	public function index()
	{
        //$data['partidos'] = $this->partido_model->get_partidos();
    	//$this->load->view('partido/home');
        redirect(base_url()."index.php/home/");
	}

    public function crear()
	{
        chrome_log("Partido: crear");
        
        if( isset($_POST) && count($_POST) > 0)
        {
            $id_partido = $this->partido_model->guardar_partido($_POST);

            if($id_partido) // Si se creó el partido
            {
                if( isset($_POST['origen']) && ($_POST['origen']=="android") )
                {
                    // WS
                    $aux["id"] = $this->db->insert_id();
                    $return["error"] = FALSE;
                    $return["data"] = $aux;
                }
                else // Llamo a armar el partido
                {
                    redirect(base_url()."index.php/partido/armar/".$id_partido);
                }

            }
            else // Si no se pudo crear el partido
            {
                if( isset($_POST['origen']) && ($_POST['origen']=="android") )
                {
                    // WS
                    $return["error"] = TRUE;
                    $return["data"] = 11; //No se ha podido crear el partido, intente mas tarde
                    crear_json($return);
                }
                else // Llamo a armar el partido
                {
                    $datos['mensaje_error'] = "No se ha podido crear el partido, intente mas tarde.";
                    $this->load->view('partido/partido', $data);
                }
            } 
        }
        else
        {
            chrome_log("NO SETEO PARTIDO");
            
            if( isset($_POST['origen']) && ($_POST['origen']=="android") )
            {
                // WS
                $return["error"] = TRUE;
                $return["data"] = 10; //Debe enviar los datos del partido.
                crear_json($return);
            }
            else
            {
                $data['tipo_partido'] = $this->partido_model->traer_tipos_partidos();
                $this->load->view('partido/partido', $data);
            }
        }  
    }

    public function editar()
    {
        chrome_log("Partido: editar");
        $id_partido = $this->uri->segment(3);

        if( 
            ( isset($_POST) && count($_POST) > 0 )      ||
            ( isset($id_partido) && !empty($id_partido) )
          )
        {

                if(!isset($_POST['id_usuario'])):
                        $id_usuario =  $this->session->userdata('id');
                        $id_partido = $this->uri->segment(3);
                else:
                        $id_usuario = $_POST['id_usuario'];
                        $id_partido = $_POST['id_partido'];
                endif;

                $administrador = $this->partido_model->es_administrador($id_usuario, $id_partido);
                
                if( $administrador) // Es administrador
                {
                   $data['datos_partido'] = $this->partido_model->traer_informacion_partido($id_partido);
                   $data['tipo_partido'] = $this->partido_model->traer_tipos_partidos();
                   $this->load->view('partido/partido', $data);
                }
                else // No es Administrador 
                {
                    
                } 
        }
        else
        {
            chrome_log("NO SETEO EL PARTIDO ");
            
            if( isset($_POST['origen']) && ($_POST['origen']=="android") )
            {
                // WS
                $return["error"] = TRUE;
                $return["data"] = 12; //Debe elegir el partido a editar
                crear_json($return);
            }
            else
            {
                redirect(base_url()."index.php/partido/ver/");
            }
        }
    }

    public function armar()
	{
        $id_partido = $this->uri->segment(3);
        
        if(isset($id_partido))
        {
            $data['partido'] = $this->partido_model->traer_informacion_partido($id_partido);
            //$data['usuarios'] = $this->usuario_model->traer_usuarios();
            $data['usuarios'] = $this->invitar_model->traer_invitados($id_partido);
            $this->load->view('equipo/armar_equipo', $data);
        }
    }   

    public function ver()
    {
        if(!isset($_POST['id_usuario']))
            $id_usuario =  $this->session->userdata('id');
        else
            $id_usuario = $_POST['id_usuario'];

        $data['mis_partidos']=$this->partido_model->traer_mis_partidos_creados($id_usuario);
        //$data['nuevos_partidos']=$this->partido_model->nuevos_partidos($id_usuario)
        $this->load->view('partido/ver_partidos',$data);
    }

}
?>
