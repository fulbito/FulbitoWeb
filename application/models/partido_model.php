<?php

// http://escodeigniter.com/guia_usuario/database/transactions.html

class Partido_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    

    /*
        Traer todo los partidos o uno en particular
    */

    public function traer_partidos($id_partido = FALSE)
	{
		chrome_log("traer_partidos");

        if($id_partido === FALSE) // [MODIFICAR] - Trae todos los partidos (hay que refinar)
        {
    		$sql = 	"SELECT *
    		         FROM partido";

    		$query = $this->db->query($sql);
            return $query->result_array();
        }
        else // Trae un partido en particular
        {
            $sql =  "SELECT *
                 FROM partido WHERE id = ? ";
            $query = $this->db->query($sql, array($id_partido));        

            return $query->row_array();
        }
        
	}


    public function traer_jugadores($id = FALSE)
	{
		$id_usuario =  $this->session->userdata('id');

        if($id === FALSE) 
        {
    		$sql = 	"SELECT *
    		         FROM usuario";
    		$query = $this->db->query($sql);
            return $query->result_array();
        }

        $sql = 	"SELECT *
  		         FROM usuario WHERE id=".$id;
  		$query = $this->db->query($sql);

		return $query->row_array();
	}

	//--- Guardar Partido  ------------------//

	public function guardar_partido($_ARRAY)
	{
        $data_partido = array();

        $data_partido['id_usuario_adm'] =  $_ARRAY['id_usuario'];
        $data_partido['fecha'] =  $_ARRAY['fecha'];
        $data_partido['hora'] =  $_ARRAY['hora'];
        $data_partido['id_tipo_partido'] =  $_ARRAY['id_tipo_partido'];
        $data_partido['id_estado_partido'] =  $this->partido_model->traer_id_estado_partido("Nuevo");
        
        if(isset($_ARRAY['cant_jugadores']) && !empty($_ARRAY['cant_jugadores']) )  //  Si cambio fecha nacimiento
            $data_partido['cant_jugadores'] = $_ARRAY['cant_jugadores'];

        $this->db->insert('partido', $data_partido); 

        return $this->db->insert_id(); 

	}

    //--- Tipos de Partido  ------------------//
    public function traer_tipos_partidos()
    {
        chrome_log("traer_tipos_partidos");
        $sql = "    SELECT  * 
                    FROM tipo_partido
                    WHERE 1 " ;
        $query = $this->db->query($sql);
        return $query;//->result_array();
    }

    //--- Id de estados de Partido  ------------------//
    public function traer_id_estado_partido($string)
    {
        chrome_log("traer_id_estado_partido");
        $sql = "    SELECT  * 
                    FROM estado_partido
                    WHERE descripcion = ? ";
        $query = $this->db->query($sql, array($string));
        return $query->row()->id;
    }



}	
    

/* End of file Login_model.php */
/* Location: ./application/models/login_model.php */
?>
