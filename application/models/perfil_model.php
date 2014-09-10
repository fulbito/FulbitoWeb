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
	
	
	
	//--- Modificar los datos obligatorios del perfil ------------------//
	/* Realiza las modificaciones de datos obligatorio.
	 * 												*/
	public function modificar_datos_obligatorios($_ARRAY)
	{
		
		$id_usuario =  $this->session->userdata('id');
		
		/* Modificar datos OBLIGATORIOS */

		$data_obligatoria = array(
		   'ALIAS' => $_ARRAY['alias'],            
		);
		
		$email_viejo = $this->Perfil_model->traer_email(); // traigo email cargado
		if( $email_viejo != $_ARRAY['email'] && !empty($_ARRAY['email']) ) // Cambio el email
			$data_obligatoria['MAIL'] = $_ARRAY['email'];
				
		if(isset($_ARRAY['password']) && !empty($_ARRAY['password']) ) //  Si cambio el password
			$data_obligatoria['PASSWORD'] = md5($_ARRAY['password']);
				
		$this->db->where('ID', $id_usuario);			
		$this->db->update('USUARIO', $data_obligatoria);
		
	}
	
	//--- Modificar los datos opcionales del perfil ------------------//
	/* Realiza las modificaciones de datos obligatorio.
	 * Si no existe, lo inserta, si existe lo actualiza				*/
	 
	public function modificar_datos_opcionales($_ARRAY)
	{		
		$id_usuario =  $this->session->userdata('id');
		$data_opcional = array();
		
		if(isset($_ARRAY['datepicker']) && !empty($_ARRAY['datepicker']) )  //  Si cambio fecha nacimiento
			$data_opcional['FECHA_NACIMIENTO'] = $_ARRAY['datepicker'];
		
		if(isset($_ARRAY['geocomplete']) && !empty($_ARRAY['geocomplete']) )  //  Si cambio ubicacion
			$data_opcional['UBICACION'] = $_ARRAY['geocomplete'];
		
		if(isset($_ARRAY['lat']) && !empty($_ARRAY['lat']) )  //  Si cambio latitud
			$data_opcional['LATITUD'] = $_ARRAY['lat'];	
			
		if(isset($_ARRAY['lng']) && !empty($_ARRAY['lng']) )  //  Si cambio ubicacion
			$data_opcional['LONGITUD'] = $_ARRAY['lng'];	
		
		if(isset($_ARRAY['sexo']) && !empty($_ARRAY['sexo']) )  //  Si cambio ubicacion
			$data_opcional['SEXO'] = $_ARRAY['sexo'];	
		
		if(isset($_ARRAY['telefono']) && !empty($_ARRAY['telefono']) )  //  Si cambio ubicacion
			$data_opcional['TELEFONO'] = $_ARRAY['telefono'];	
		
		if(isset($_ARRAY['radio']) && !empty($_ARRAY['radio']) )  //  Si cambio ubicacion
			$data_opcional['RADIO_BUSQUEDA_PARTIDOS'] = $_ARRAY['radio'];
	
		if($this->Perfil_model->existen_datos_opcionales()) // Si existe ACTUALIZO
		{
			$this->db->where('ID_USUARIO', $id_usuario);
			$this->db->update('DATOS_OPCIONALES_USUARIO', $data_opcional); 
		}
		else // Si no existe INSERTO
		{
			$data_opcional['ID_USUARIO'] = $id_usuario;	
			$this->db->insert('DATOS_OPCIONALES_USUARIO', $data_opcional); 
		}
	}
}	
    

/* End of file Login_model.php */
/* Location: ./application/models/login_model.php */
?>
