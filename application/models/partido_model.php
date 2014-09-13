<?php

// http://escodeigniter.com/guia_usuario/database/transactions.html

class Partido_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
	//---Trae los datos del perfil, opcionales y obligatorios  ------------------//
    public function traer_datos()
	{
		$id_usuario =  $this->session->userdata('id');
		chrome_log("Perfil traer_datos_perfil");
		$sql = 	"	SELECT *
					FROM 	USUARIO AS u LEFT JOIN DATOS_OPCIONALES_USUARIO AS d
							ON ( u.ID = d.ID_USUARIO )
					WHERE u.ID = ? ";
		$query = $this->db->query($sql, array($id_usuario));
		return $query;
	}
	
	//--- Modificar los datos obligatorios del perfil ------------------//
	/* Realiza las modificaciones de datos obligatorio.*/
	public function crear()
	{
        $data = array(
    		'nombre' => $this->input->post('nombre'),
    		'fecha' => $this->input->post('fecha'),
    		'hora' => $this->input->post('hora'),
    		'cancha' => $this->input->post('cancha')
    	);

        $this->db->insert('partido', $data);
    	return $this->db->insert_id();
	}

}	
    

/* End of file Login_model.php */
/* Location: ./application/models/login_model.php */
?>
