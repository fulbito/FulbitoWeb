<?php

// SQL INJECTION: http://devzone.co.in/prevent-sql-injection-codeigniter-ci/

class Login_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
	//--- Comprueba correo y clave existan (ingresar) ------------------//
    public function loguearse($correo,$clave)
	{
		
		$clave= md5($clave);
		$sql =  "	SELECT * 
					FROM USUARIO 
					WHERE MAIL = ? AND 
						  PASSWORD  = ?	";		  
		$query = $this->db->query($sql, array($correo, $clave));
		return $query;
	}
	
	//--- Comprueba correo que el correo ya exista (AJAX registrarse)------------------//
	public function existeCorreo($correo)
	{
		$sql = "	SELECT  * 
					FROM USUARIO
					WHERE MAIL = ? " ;
		$query = $this->db->query($sql, array($correo));
		return $query->result_array();
	}
	
	//--- Registrar nuevo usuario (AJAX registrarse)	------------------//
	public function registrarse($alias, $email, $password )
	{	
		$foto = 'default.jpg';
		chrome_log("registrarse_model");
		$sql = "	INSERT INTO USUARIO(MAIL, PASSWORD, ALIAS, PATH_FOTO ) 
					VALUES ( ? , ? , ? ,? )";
		$query = $this->db->query($sql, array($email,$password, $alias,$foto));			
		$affected_rows = $this->db->affected_rows();
		chrome_log($affected_rows);
		return $affected_rows;
	}
	
	//--- Devuelve el password viejo a la hora de cambiarlo ------------------//
	public function guardarPasswordViejo($correo)
	{
		chrome_log("guardarPasswordViejo");
		$sql = " SELECT PASSWORD FROM USUARIO WHERE MAIL = ? ";
		$query = $this->db->query($sql, array($correo));
		return $query->row();
	}
	
	//--- Cambia el password viejo  ------------------//
	public function cambiar_password($codigoCodificado,$correo)
	{
		chrome_log("cambiar_password");
		chrome_log("UPDATE USUARIO SET PASSWORD = '$codigoCodificado' WHERE MAIL = '$correo'");
		$sql = "UPDATE USUARIO SET PASSWORD = ? WHERE MAIL = ? ";
		$query = $this->db->query($sql, array($codigoCodificado,$correo));
		return $query;
	}
}	
    

/* End of file Login_model.php */
/* Location: ./application/models/login_model.php */
?>
