<?php

class Perfil_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
	//--- Comprueba correo y clave existan (ingresar) ------------------//
    public function traer_datos_perfil($correo)
	{
		chrome_log("Perfil traer_datos_perfil");
		$sql = 	"	SELECT *
					FROM 	USUARIO AS u LEFT JOIN DATOS_OPCIONALES_USUARIO AS d
							ON ( u.ID = d.ID_USUARIO )
					WHERE u.MAIL = ? ";
		$query = $this->db->query($sql, array($correo));
		return $query;
	}
	
}	
    

/* End of file Login_model.php */
/* Location: ./application/models/login_model.php */
?>
