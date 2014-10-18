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
                else // Llamo a configurar el equipo
                {
                    redirect(base_url()."index.php/partido/ver_configuracion_partido/".$id_partido);
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
                    $data['tipo_visibilidad_partido'] = $this->partido_model->traer_tipos_visibilidad_partidos();
                    $this->load->view('partido/partido', $data);
                }
            } 
        }
        else
        {
            chrome_log("No envio informacion para crear el partido");
            
            if( isset($_POST['origen']) && ($_POST['origen']=="android") )
            {
                // WS
                $return["error"] = TRUE;
                $return["data"] = 10; //Debe enviar los datos del partido.
                crear_json($return);
            }
            else
            {
                $data['tipo_visibilidad_partido'] = $this->partido_model->traer_tipos_visibilidad_partidos();
                $this->load->view('partido/partido', $data);
            }
        }  
    }

    public function editar($id_partido)
    {
        chrome_log("Partido: editar");

        if(!isset($id_partido) ) //---------------------- NO envio el ID de Partido a Editar -------//
        {
            if( isset($_POST['origen']) && ($_POST['origen']=="android") )
            {
                // WS
                $return["error"] = TRUE;
                $return["data"] = 12; //Debe elegir el partido a editar
                crear_json($return);
            }
            else
            {
                redirect(base_url()."index.php/partido/mis_partidos/");
            }

        }
        else //----------------------- MODIFICAR LOS DATOS ---------------------//
        {
            
            if( isset($_POST) && count($_POST) > 0 ) // Modificar los datos
            {
                chrome_log(" Entra a modificar el partido ");

                if(!isset($_POST['id_usuario']))
                    $id_usuario =  $this->session->userdata('id');
                else
                    $id_usuario = $_POST['id_usuario'];

                chrome_log($id_usuario);


                $administrador = $this->partido_model->es_administrador($id_usuario, $id_partido);
                
                if( $administrador) // Es administrador
                {
                    chrome_log("Es administrador");

                    $resultado = $this->partido_model->modificar_partido($_POST); 

                    if($resultado)
                    {
                        chrome_log("Cambio exitoso");  
                        $return["error"] = false;
                        $data['mensaje_exito'] = "Se ha modificar el partido exitosamente.";
                    }
                    else
                    {
                        chrome_log("Cambio no exitoso");    
                       
                        $return["error"] = TRUE;
                        $return["data"] = 12; // "No se ha podido modificar el partido.";
                        $data['mensaje_error'] = "No se ha podido modificar el partido.";
                    }
                }
                else // No es administrador
                {
                    chrome_log("No es administrador");    
                       
                    $return["error"] = TRUE;
                    $return["data"] = 12; // No es administrador
                    $data['mensaje_error'] = "Usted no es administrador del partido.";
                }

                if( isset($_POST['origen']) && ($_POST['origen']=="android") )
                {
                    crear_json($return);
                }
                else
                {
                    chrome_log("Admin ".$administrador);
                    $data['datos_partido'] = $this->partido_model->traer_informacion_partido($id_partido);
                    $data['tipo_visibilidad_partido'] = $this->partido_model->traer_tipos_visibilidad_partidos();
                    $this->load->view('partido/partido', $data);
                }

            }
            else // No envio los datos
            {
                if( isset($_POST['origen']) && ($_POST['origen']=="android") )
                {
                    // WS
                    $return["error"] = TRUE;
                    $return["data"] = 12; //Debe enviar los datos del partido
                    crear_json($return);
                }
                else
                {
                    redirect(base_url()."index.php/partido/ver_partido/".$id_partido);
                }

            }

               
        }
    }
    

    public function mis_partidos()
    {
        if(!isset($_POST['id_usuario']))
            $id_usuario =  $this->session->userdata('id');
        else
            $id_usuario = $_POST['id_usuario'];

        $data['mis_partidos']=$this->partido_model->traer_mis_partidos_creados($id_usuario);
        $this->load->view('partido/ver_partidos',$data);
    }

    public function ver_partido($id_partido)
    {
        chrome_log("ver_partido".$id_partido);

        if(!isset($id_partido) )
        {
            redirect(base_url()."index.php/partido/mis_partidos");
            chrome_log("No esta seteado");
        }
        else
        {
            chrome_log("SETEADO ".$id_partido);
            $id_usuario =  $this->session->userdata('id');
            $administrador = $this->partido_model->es_administrador($id_usuario, $id_partido);

            if( $administrador) // Es administrador
            {
               chrome_log("Admin ".$administrador);
               $data['datos_partido'] = $this->partido_model->traer_informacion_partido($id_partido);
               $data['tipo_visibilidad_partido'] = $this->partido_model->traer_tipos_visibilidad_partidos();

               $this->load->view('partido/partido', $data);
            }
            else // No es Administrador 
            {
                $datos['mensaje_error'] = "Usted no es administrador del partido.";
                redirect(base_url()."index.php/partido/mis_partidos");
            }

        }
    }

    /*
        Ver la configuracion del partido
    */
    public function ver_configuracion_partido($id_partido)
    {
        chrome_log("Controlador PARTIDO/ver_configuracion_partido ");
        
        if(!isset($id_partido)) // No mando el ID , SALE
        {
            if( isset($_POST['origen']) && ($_POST['origen']=="android") )
            {
                // WS
                $return["error"] = TRUE;
                $return["data"] = 12; //Debe enviar el ID del partido.
                crear_json($return);
            }
            else
            {
                redirect(base_url()."index.php/partido/mis_partidos/");
            }
        }
        else
        {
            if(!isset($_POST['id_usuario']))
                $id_usuario =  $this->session->userdata('id');
            else
                $id_usuario = $_POST['id_usuario'];

            $administrador = $this->partido_model->es_administrador($id_usuario, $id_partido);
             
               
            if( $administrador) // Es administrador
            {
                chrome_log("Es administrador");

                $data['datos_partido'] = $this->partido_model->traer_informacion_partido($id_partido);
                $data['tipo_seleccion_jugadores'] = $this->partido_model->traer_tipos_seleccion_jugadores();
                $data['tipo_partido'] = $this->partido_model->traer_tipos_partidos();
                $this->load->view('partido/configurar', $data);
                
            }
            else // No es administrador
            {
                chrome_log("No es administrador");    
                   
                $return["error"] = TRUE;
                $return["data"] = 12; // Usted no puede configurar este partido, no es su admisnitrador.

                $datos['mensaje_error'] = "Usted no es administrador del partido.";
            }

        }
    }


    public function configurar()
    {
        chrome_log("Controlador PARTIDO/configurar ");

        if(!isset($_POST['id_partido'])) // No mando el ID , SALE
        {

            if( isset($_POST['origen']) && ($_POST['origen']=="android") )
            {
                // WS
                $return["error"] = TRUE;
                $return["data"] = 12; //Debe enviar el ID del partido a configurar
                crear_json($return);
            }
            else
            {
                redirect(base_url()."index.php/partido/mis_partidos/");
            }
        }
        else
        {

            if( isset($_POST) && count($_POST) > 0)
            {
               
                switch($_POST['tipo_partido']):
                    
                    case 1:
                            $this->partido_model->configurar_partido_amistoso($_POST);
                            break;

                    case 2:
                            $this->partido_model->configurar_partido_desafio_jugador($_POST);
                            break;

                    case 3:
                            $this->partido_model->configurar_partido_desafio_equipo($_POST);
                            break;

                endswitch; 
            }
            else
            {
                chrome_log("NO SETEO configurar");
                
                if( isset($_POST['origen']) && ($_POST['origen']=="android") )
                {
                    //WS
                    $return["error"] = TRUE;
                    $return["data"] = 10; //Debe enviar los datos del partido.
                    crear_json($return);
                }
                else
                {
                   

                }
            }

        }
    }     
}
?>