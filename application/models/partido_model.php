<?php

// http://escodeigniter.com/guia_usuario/database/transactions.html

class Partido_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    

    public function get_partidos($id = FALSE)
	{
		$id_usuario =  $this->session->userdata('id');

        if($id === FALSE)
        {
    		$sql = 	"SELECT *
    		         FROM partido";
    		$query = $this->db->query($sql);
            return $query->result_array();
        }

        $sql = 	"SELECT *
  		         FROM partido WHERE id=".$id;
  		$query = $this->db->query($sql);

		return $query->row_array();
	}


    public function get_jugadores($id = FALSE)
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
