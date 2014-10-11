<?php

// http://escodeigniter.com/guia_usuario/database/transactions.html

class Usuario_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    //---Trae los datos del perfil, opcionales y obligatorios  ------------------//
    public function traer_usuarios($id_usuario = FALSE)
	{
	    if($id_usuario === FALSE)
        {
            $sql = 	"SELECT *
					FROM usuario AS u LEFT JOIN datos_opc_usuario AS d
							ON ( u.id = d.id_usuario )";
            $query = $this->db->query($sql);
            return $query->result_array();
        }

		$sql = 	"SELECT *
    			FROM usuario AS u LEFT JOIN datos_opc_usuario AS d
    					ON ( u.id = d.id_usuario )
    			WHERE u.id = ? ";
		$query = $this->db->query($sql, array($id_usuario));
		return $query->row_array();
	}

    //---Trae los datos del perfil de amigos ------------------//
    public function traer_amigos($id_usuario = FALSE)
	{
	    if($id_usuario === FALSE)
        {
            return FALSE;
        }

		$sql = 	"SELECT *
    			FROM usuario AS u INNER JOIN amigo AS a
    					ON ( u.id = a.id_usuario_amigo )
    			WHERE a.id_usuario = ? ";
		$query = $this->db->query($sql, array($id_usuario));
		return $query->result_array();
	}
	
	//--- Trae el email cargado ------------------//
    public function traer_email()
	{
		$id_usuario =  $this->session->userdata('id');
		chrome_log("Perfil traer_email");
		$sql = 	"	SELECT email
					FROM  usuario u
					WHERE u.id = ? ";
		$query = $this->db->query($sql, array($id_usuario));
		$row = $query->row();
		return $row->email;
	}
	
	//--- Devuelve si existen datos opcionales ------------------//
    public function existen_datos_opcionales($id_usuario)
	{
		//$id_usuario =  $this->session->userdata('id');
		chrome_log("Perfil: existe_datos_opcionales");
		$sql = 	"	SELECT * 
					FROM datos_opc_usuario 
					WHERE id_usuario = ? ";
					
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
					FROM usuario
					WHERE email = ? AND id != ? " ;
		$query = $this->db->query($sql, array($correo,$id_usuario));
		return $query->result_array();
	}
	
	
	
	//--- Modificar los datos obligatorios del perfil ------------------//
	/* Realiza las modificaciones de datos obligatorio.
	 * 												*/
	public function modificar_datos_obligatorios($_ARRAY)
	{
		
		//$id_usuario =  $this->session->userdata('id');
		$id_usuario = $_ARRAY['id_usuario'];
		
		/* Modificar datos OBLIGATORIOS */

		$data_obligatoria = array(
		   'alias' => $_ARRAY['alias'],            
		);
		
		/* NO SE PERMITE CAMBIAR EL EMAIL 
		$email_viejo = $this->Perfil_model->traer_email(); // traigo email cargado
		if( $email_viejo != $_ARRAY['email'] && !empty($_ARRAY['email']) ) // Cambio el email
			$data_obligatoria['email'] = $_ARRAY['email'];*/
				
		if(isset($_ARRAY['password']) && !empty($_ARRAY['password']) ) //  Si cambio el password
			$data_obligatoria['password'] = md5($_ARRAY['password']);
				
		$this->db->where('id', $id_usuario);			
		$this->db->update('usuario', $data_obligatoria);
		
	}
	
	//--- Modificar los datos opcionales del perfil ------------------//
	/* Realiza las modificaciones de datos obligatorio.
	 * Si no existe, lo inserta, si existe lo actualiza				*/
	 
	public function modificar_datos_opcionales($_ARRAY)
	{		
		//$id_usuario =  $this->session->userdata('id');
		$id_usuario = $_ARRAY['id_usuario'];
		
		$data_opcional = array();
		
		if(isset($_ARRAY['datepicker']) && !empty($_ARRAY['datepicker']) )  //  Si cambio fecha nacimiento
			$data_opcional['fecha_nacimiento'] = $_ARRAY['datepicker'];
		
		if(isset($_ARRAY['geocomplete']) && !empty($_ARRAY['geocomplete']) )  //  Si cambio ubicacion
			$data_opcional['ubicacion'] = $_ARRAY['geocomplete'];
		
		if(isset($_ARRAY['lat']) && !empty($_ARRAY['lat']) )  //  Si cambio latitud
			$data_opcional['latitud'] = $_ARRAY['lat'];	
			
		if(isset($_ARRAY['lng']) && !empty($_ARRAY['lng']) )  //  Si cambio ubicacion
			$data_opcional['longitud'] = $_ARRAY['lng'];	
		
		if(isset($_ARRAY['sexo']) && !empty($_ARRAY['sexo']) )  //  Si cambio ubicacion
			$data_opcional['sexo'] = $_ARRAY['sexo'];	
		
		if(isset($_ARRAY['telefono']) && !empty($_ARRAY['telefono']) )  //  Si cambio ubicacion
			$data_opcional['telefono'] = $_ARRAY['telefono'];	
		
		if(isset($_ARRAY['radio']) && !empty($_ARRAY['radio']) )  //  Si cambio ubicacion
			$data_opcional['radio_busqueda_partido'] = $_ARRAY['radio'];
	
		if($this->Perfil_model->existen_datos_opcionales($id_usuario)) // Si existe ACTUALIZO
		{
			$this->db->where('id_usuario', $id_usuario);
			$this->db->update('datos_opc_usuario', $data_opcional); 
		}
		else // Si no existe INSERTO
		{
			$data_opcional['id_usuario'] = $id_usuario;	
			$this->db->insert('datos_opc_usuario', $data_opcional); 
		}
	}
	
	//--- Traer nombre archivo ------------------//
    public function traer_nombre_foto()
	{
		$id_usuario =  $this->session->userdata('id');
		chrome_log("Perfil: actualizar_nombre_foto");
		
		$sql = 	"	SELECT  foto
					FROM usuario
					WHERE   id  = ? ";
		$query = $this->db->query($sql, array($id_usuario));
		$row = $query->row();
		return $row->foto; 
	}
	
	//--- Actualizar nombre archivo ------------------//
    public function actualizar_nombre_foto($nombre_archivo)
	{
		$id_usuario =  $this->session->userdata('id');
		chrome_log("Perfil: actualizar_nombre_foto");
		
		$sql = 	"	UPDATE   usuario 
					SET   foto  =  ? 
					WHERE  id  = ? ";
		$query = $this->db->query($sql, array($nombre_archivo, $id_usuario));
		$cantidad=$this->db->affected_rows();
	    if($cantidad>0)
			return true;
		else
			return false;
	}
}	
    

/* End of file Login_model.php */
/* Location: ./application/models/login_model.php */
?>
