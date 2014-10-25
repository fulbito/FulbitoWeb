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
    public function traer_informacion_partido($id_partido)
	{
        chrome_log("PARTIDO_MODEL/traer_informacion_partido"); 

        $sql =  "SELECT *
                 FROM partido 
                 WHERE id = ? ";
        
        chrome_log("SELECT *
                 FROM partido 
                 WHERE id = $id_partido "); 

        $query = $this->db->query($sql, array($id_partido));        

        return $query->row();  
	}

    /*
        Trae los partidos donde el usuario es administrador
    */
    public function traer_mis_partidos_creados($id_usuario)
    {
        chrome_log("PARTIDO_MODEL/traer_mis_partidos_creados");    

        $sql =  "SELECT *
                 FROM partido 
                 WHERE id_usuario_adm = ? "; 

        $query = $this->db->query($sql, array($id_usuario));        

        return $query;
                
    }

    /*
        Guarda un partido
    */
	public function guardar_partido($_ARRAY)
	{
        chrome_log("PARTIDO_MODEL/guardar_partido");

        $data_partido = array();

        $data_partido['id_usuario_adm'] =  $_ARRAY['id_usuario'];
        $data_partido['fecha'] =  $_ARRAY['fecha'];
        $data_partido['hora'] =  $_ARRAY['hora'];
        $data_partido['id_tipo_visibilidad_partido'] =  $_ARRAY['id_tipo_visibilidad_partido'];
        $data_partido['id_estado_partido'] =  $this->partido_model->traer_id_estado_partido("Nuevo");
        
        if(isset($_ARRAY['cant_jugadores']) && !empty($_ARRAY['cant_jugadores']) )  //  Si cambio fecha nacimiento
            $data_partido['cant_jugadores'] = $_ARRAY['cant_jugadores'];

        if(isset($_ARRAY['nombre']) && !empty($_ARRAY['nombre']) )  //  Si cambio fecha nacimiento
            $data_partido['nombre'] = $_ARRAY['nombre'];    

        $this->db->insert('partido', $data_partido); 

        return $this->db->insert_id(); 

	}

    /*
        Modificar un partido
    */
    public function modificar_partido($_ARRAY)
    {
        chrome_log("PARTIDO_MODEL/modificar_partido");

        $data_partido = array();
        $data_partido['fecha'] =  $_ARRAY['fecha'];
        $data_partido['hora'] =  $_ARRAY['hora'];         
        $data_partido['id_tipo_visibilidad_partido'] =  $_ARRAY['id_tipo_visibilidad_partido'];
        
        if(isset($_ARRAY['nombre']) && !empty($_ARRAY['nombre']) )  //  Si cambio fecha nacimiento
            $data_partido['nombre'] = $_ARRAY['nombre'];
        
        if(isset($_ARRAY['cant_jugadores']) && !empty($_ARRAY['cant_jugadores']) )  //  Si cambio ubicacion
            $data_partido['cant_jugadores'] = $_ARRAY['cant_jugadores'];
        
        $this->db->where('id', $_ARRAY['id_partido']);
        $this->db->update('partido',$data_partido);

        return $this->db->affected_rows();
    }

    /* 
        Devuelve los tipos de partidos 
    */
    public function traer_tipos_partidos()
    {
        chrome_log("PARTIDO_MODEL/traer_tipos_partidos");

        $sql = "    SELECT  * 
                    FROM tipo_partido
                    WHERE 1 " ;
        $query = $this->db->query($sql);
        return $query;//->result_array();
    }

    /* 
        Devuelve los tipos de visibilidad partidos: id y descripcion (privado o publico )
    */
    public function traer_tipos_visibilidad_partidos()
    {
        chrome_log("PARTIDO_MODEL/traer_tipos_visibilidad_partidos");


        $sql = "    SELECT  * 
                    FROM tipo_visibilidad_partido
                    WHERE 1 " ;  
        $query = $this->db->query($sql);

        return $query;//->result_array();

    }

    /* 
        Devuelve los tipos de seleccion de jugadores
    */
    public function traer_tipos_seleccion_jugadores()
    {
        chrome_log("PARTIDO_MODEL/traer_tipos_seleccion_jugadores");

        $sql = "    SELECT  * 
                    FROM tipo_seleccion_jugadores
                    WHERE 1 " ;
        $query = $this->db->query($sql);
        return $query;//->result_array();
    }

    
    /* 
        Devuelve informacion de estado recibido : id y descripcion ( Estados : nuevo, con invitaciones, listo, finalizado)
    */
    public function traer_id_estado_partido($string)
    {
        chrome_log("PARTIDO_MODEL/traer_id_estado_partido");

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
        chrome_log("PARTIDO_MODEL/es_administrador");
        
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

        if(!$this->existe_partido_amistoso($_ARRAY['id_partido'])) // Si no existe el partido amistoso
        {
            $sql = "    INSERT  INTO partido_amistoso(id_partido, id_tipo_seleccion_jugadores ) 
                        VALUES ( ? , ? )";
                    
            $query = $this->db->query($sql, array($_ARRAY['id_partido'],$_ARRAY['tipo_seleccion_jugadores'])); 
        }
        else // Si existe solo cambiamos el id_tipo_seleccion_jugadores
        {
            $sql = "UPDATE partido_amistoso SET id_tipo_seleccion_jugadores = ? WHERE id_partido = ? ";
            $query = $this->db->query($sql, array($_ARRAY['tipo_seleccion_jugadores'],$_ARRAY['id_partido']));
            return $query;
        }

        $affected_rows = $this->db->affected_rows();
        chrome_log($affected_rows);
    }

    public function configurar_partido_desafio_jugador($_ARRAY)
    {
        chrome_log("configurar_partido_desafio_jugador");
         
        $sql = " INSERT  INTO partido_desafio_jugador(id_partido, id_usuario_desafiante, id_usuario_desafiado ) 
                        VALUES ( ? , ? , ?  )";
                    
        $query = $this->db->query($sql, array($_POST['id_partido'],$_POST['id_jugador_desafiante'],$_POST['id_jugador_desafiado']));  

        $affected_rows = $this->db->affected_rows();
        chrome_log($affected_rows);
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


    public function setear_tipo_partido($id_partido, $id_tipo_partido)
    {
        chrome_log("setear_tipo_partido");
        
        $sql = "UPDATE partido SET id_tipo_partido = ? WHERE id = ? ";
        $query = $this->db->query($sql, array($id_tipo_partido,$id_partido));
        return $query;
        
        if($query->row())
            return true;
        else
            return false;
    }

    public function existe_partido_amistoso($id_partido)
    {
        chrome_log("existe_partido_amistoso");
        
        $sql = "   SELECT  * 
                    FROM partido_amistoso
                    WHERE id_partido = ? ";

        $query = $this->db->query($sql, array($id_partido));
        
        if($query->row())
            return true;
        else
            return false;
    }

}	
    

/* End of file Login_model.php */
/* Location: ./application/models/login_model.php */
?>