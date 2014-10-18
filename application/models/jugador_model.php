<?php

// http://escodeigniter.com/guia_usuario/database/transactions.html

class jugador_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    //---Trae los datos del perfil de amigos ------------------//
    public function traer_jugadores($id_partido = FALSE)
	{
	    if($id_partido === FALSE)
        {
            return FALSE;
        }

		$sql = 	"SELECT *
    			FROM usuario AS u INNER JOIN jugador AS j
    					ON ( u.id = j.id_jugador )
    			WHERE j.id_partido = ? ";
		$query = $this->db->query($sql, array($id_partido));
		return $query->result_array();
	}          

    public function guardar_jugador($id_partido, $id_usuario, $id_estado, $id_tipo_adhesion, $fecha_adhesion)
	{
        $data = array();

        $data['id_partido'] =  $id_partido;
        $data['id_usuario'] =  $id_usuario;
        $data['id_estado'] =  $id_estado;
        $data['id_tipo_adhesion'] =  $id_tipo_adhesion;
        $data['fecha_adhesion'] =  $fecha_adhesion;

        $this->db->insert('adhesion_partido', $data);

        return $this->db->affected_rows();

	}

    public function borrar_jugador($id_partido, $id_jugador)
	{
        $data = array();

        $data['id_partido'] =  $id_partido;
        $data['id_jugador'] =  $id_usuario;
        $data['id_estado'] =  $id_estado;
        $data['id_tipo_adhesion'] =  $id_tipo_adhesion;
        $data['fecha_adhesion'] =  $fecha_adhesion;

        $this->db->delete('adhesion_partido', $data);

        return $this->db->affected_rows();

	}

}	
    

/* End of file Login_model.php */
/* Location: ./application/models/login_model.php */
?>
