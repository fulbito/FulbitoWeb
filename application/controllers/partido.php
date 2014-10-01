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
        //$data['partidos'] = $this->partido_model->get_partidos();
    	//$this->load->view('partido/home', $data);
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
                    $this->load->view('partido/crear_partido', $data);
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
                $this->load->view('partido/crear_partido', $data);
            }
        }  
    } 
       

    public function armar()
	{
        $id_partido = $this->uri->segment(3);
        
        if(isset($id_partido))
        {
            $data['partido'] = $this->partido_model->traer_partidos($id_partido);
            $this->load->view('partido/armar_partido', $data);
        }
        

        
     
        /*
        $data['error'] = "";
        $data['partido'] = $this->partido_model->get_partidos($id);
        $data['jugadores'] = $this->partido_model->get_jugadores();

        if ($this->form_validation->run() === FALSE)
    	{
    		$this->load->view('partido/armar_partido', $data);
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
              $this->load->view('partido/armar_partido', $data);
            }
    	} */
	}

}
?>
