<?php

// http://escodeigniter.com/guia_usuario/database/transactions.html

class Perfil_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
	//---Trae los datos del perfil, opcionales y obligatorios  ------------------//
    public function traer_datos_perfil()
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
	
	//--- Trae el email cargado ------------------//
    public function traer_email()
	{
		$id_usuario =  $this->session->userdata('id');
		chrome_log("Perfil traer_email");
		$sql = 	"	SELECT MAIL
					FROM  USUARIO u
					WHERE u.ID = ? ";
		$query = $this->db->query($sql, array($id_usuario));
		$row = $query->row();
		return $row->MAIL;
	}
	
	//--- Devuelve si existen datos opcionales ------------------//
    public function existen_datos_opcionales()
	{
		$id_usuario =  $this->session->userdata('id');
		chrome_log("Perfil: existe_datos_opcionales");
		$sql = 	"	SELECT * 
					FROM DATOS_OPCIONALES_USUARIO 
					WHERE ID_USUARIO = ? ";
					
		$query = $this->db->query($sql, array($id_usuario));
		
		if( $query->num_rows() > 0 )
			return true;
		else
			return false;
	}
	
	//--- Comprueba correo que el correo ya exista y no sea el de este usuario ----------//
	public function existeCorreoDuplicado($correo)
	{			
		
		$id_usuario =  $this->session->userdata('id');
		$sql = "	SELECT  * 
					FROM USUARIO
					WHERE MAIL = ? AND ID != ? " ;
		$query = $this->db->query($sql, array($correo,$id_usuario));
		return $query->result_array();
	}
	
	
	
	//--- Modificar los datos del perfil ------------------//
	/* Realiza las modificaciones de datos obligatorio y ocionales en una transaccion
	 * atomica.
	 * */
	 
	public function modificar_datos_perfil($alias, $email, $password)
	{
		$this->db->trans_start(); // INICIA UNA TRASACCION
		$id_usuario =  $this->session->userdata('id');
		
		/* Modificar datos OBLIGATORIOS */
		
		$email_viejo = $this->Perfil_model->traer_email(); // traigo email cargado
		
		$sql = " UPDATE USUARIO SET ALIAS = ? ";
		$valores = array($alias);
		
		if( $email_viejo != $email && !empty($email) ) // Cambio el email
		{
			$sql.=", MAIL = ? ";
			array_push($valores,$email);
		}
		
		if(isset($password) && !empty($password) ) //  Si cambio el password
		{
			$password = md5($_POST['password']);
			$sql.= ", PASSWORD = ? ";
			array_push($valores,$password);
		}		
		
		$sql.= " WHERE ID = ? ";
		array_push($valores,$id_usuario);
		$query = $this->db->query($sql, $valores);
		
		/* MOdificar datos OPCIONALES */
		
		if($this->Perfil_model->existen_datos_opcionales()) // Si existe ACTUALIZO
		{
			echo "existe";
		
		}
		else // Si no existe INSERTO
		{
			echo "no existe";
			
		
		}
		
		/*
		$affected_rows = $this->db->affected_rows();
		return $affected_rows;*/
	}
	
}	
    

/* End of file Login_model.php */
/* Location: ./application/models/login_model.php */
?>
