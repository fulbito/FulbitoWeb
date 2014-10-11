<?php

// http://escodeigniter.com/guia_usuario/database/transactions.html

class invitar_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    //---Trae los datos del perfil de amigos ------------------//
    public function traer_invitados($id_partido = FALSE)
	{
	    if($id_partido === FALSE)
        {
            return FALSE;
        }

		$sql = 	"SELECT *
    			FROM usuario AS u INNER JOIN adhesion_partido AS ap
    					ON ( u.id = ap.id_usuario )
    			WHERE ap.id_partido = ? ";
		$query = $this->db->query($sql, array($id_partido));
		return $query->result_array();
	}

    public function traer_usuarios_no_invitados($id_partido = FALSE)
	{
	    if($id_partido === FALSE)
        {
            return FALSE;
        }

		$sql = 	"SELECT *
    			FROM usuario AS u
    			WHERE NOT EXISTS ( SELECT 1
                                    FROM usuario AS u1
                                    INNER JOIN adhesion_partido AS ap ON u1.id = ap.id_usuario
                                    WHERE ap.id_partido = ? AND u.id = u1.id)";
		$query = $this->db->query($sql, array($id_partido));
		return $query->result_array();
	}

    //---Trae los datos del perfil de amigos ------------------//
    public function traer_amigos_no_invitados($id_usuario = FALSE, $id_partido = FALSE)
	{
	    if($id_usuario === FALSE || $id_partido === FALSE)
        {
            return FALSE;
        }

		$sql = 	"SELECT *
    			FROM usuario AS u INNER JOIN amigo AS a
    					ON ( u.id = a.id_usuario_amigo )
    			WHERE a.id_usuario = ? AND NOT EXISTS ( SELECT 1
                                                        FROM usuario AS u1
                                                        INNER JOIN adhesion_partido AS ap ON u1.id = ap.id_usuario
                                                        WHERE ap.id_partido = ? AND u.id = u1.id)";
		$query = $this->db->query($sql, array($id_usuario, $id_partido));
		return $query->result_array();
	}

    public function guardar_invitado($id_partido, $id_usuario, $id_estado, $id_tipo_adhesion, $fecha_adhesion)
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

}	
    

/* End of file Login_model.php */
/* Location: ./application/models/login_model.php */
?>
