<?php

// Transacciones:  http://escodeigniter.com/guia_usuario/database/transactions.html

class Partido_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    

    /*
      Trae la informacion de un partido en particular
    */
    public function traer_informacion_partido($id_partido = FALSE)
	{
        $sql =  "SELECT *
                 FROM partido 
                 WHERE id = ? ";
    
        $query = $this->db->query($sql, array($id_partido));        

        return $query->row();
                
	}

    /*
      Trae los partidos donde el usuario es administrador
    */
    public function traer_mis_partidos_creados($id_usuario)
    {
        chrome_log("traer_mis_partidos_creados");    

        $sql =  "SELECT *
                 FROM partido 
                 WHERE id_usuario_adm = ? "; 

        $query = $this->db->query($sql, array($id_usuario));        

        return $query;
                
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

    /*
        Guarda un partido
    */
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

    /* 
        Devuelve los tipos de partidos: id y descripcion (privado o publico )
    */
    public function traer_tipos_partidos()
    {
        chrome_log("traer_tipos_partidos");
        $sql = "    SELECT  * 
                    FROM tipo_partido
                    WHERE 1 " ;
        $query = $this->db->query($sql);
        return $query;//->result_array();
    }

    
    /* 
        Devuelve informacion de estado recibido : id y descripcion ( Estados : nuevo, con invitaciones, listo, finalizado)
    */
    public function traer_id_estado_partido($string)
    {
        chrome_log("traer_id_estado_partido");
        $sql = "    SELECT  * 
                    FROM estado_partido
                    WHERE descripcion = ? ";
        $query = $this->db->query($sql, array($string));
        return $query->row()->id;
    }

    /*
        Se fija si puede editar el partido
    */

    public function es_administrador($id_usuario, $id_partido)
    {
        chrome_log("es_administrador");
        
        $sql = "    SELECT  * 
                    FROM partido
                    WHERE id = ? AND
                          id_usuario_adm = ?  ";

        $query = $this->db->query($sql, array($id_partido,$id_usuario));
        
        if($query->row())
            return true;
        else
            return false;
    }

    public function configurar_partido_amistoso($_ARRAY)
    {
        chrome_log("configurar_partido_amistoso");
         
        
         
        $sql = "    SELECT  * 
                    FROM partido
                    WHERE id = ? AND
                          id_usuario_adm = ?  ";

        $query = $this->db->query($sql, array($id_partido,$id_usuario));
        
        if($query->row())
            return true;
        else
            return false; 
    }

    public function configurar_partido_desafio_jugador($_ARRAY)
    {
        chrome_log("configurar_partido_desafio_jugador");
        /*
        $sql = "    SELECT  * 
                    FROM partido
                    WHERE id = ? AND
                          id_usuario_adm = ?  ";

        $query = $this->db->query($sql, array($id_partido,$id_usuario));
        
        if($query->row())
            return true;
        else
            return false;*/
    }

    public function configurar_partido_desafio_equipo($_ARRAY)
    {
        chrome_log("configurar_partido_desafio_equipo");
        /*
        $sql = "    SELECT  * 
                    FROM partido
                    WHERE id = ? AND
                          id_usuario_adm = ?  ";

        $query = $this->db->query($sql, array($id_partido,$id_usuario));
        
        if($query->row())
            return true;
        else
            return false;*/
    }



}	
    

/* End of file Login_model.php */
/* Location: ./application/models/login_model.php */
?>
