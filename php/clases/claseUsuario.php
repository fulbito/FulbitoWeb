<?
/*
	d: double.
	i: integer.
	s: string.
	b: bool.
*/

class Usuario {

	// var $dIdUsuario; // Autoincremental
	var $sAlias;
	var $sEmail;
	var $sFoto;
	var $sPassword;
	var $bEstado;
	
	// Constructor
	function Usuario($sAlias, $sEmail, $sFoto=NULL, $sPassword=NULL) 
	{
		$this->sAlias = $sAlias;
		$this->sEmail = $sEmail;
		$this->sFoto = $sFoto;
		$this->sPassword = $sPassword;
		$this->bEstado = 1;
	}
	
	// Funciones para establecer y obtener las propiedades del objeto 
		
	//-- Alias
	function getAlias() 
	{
		return $this->sAlias;
	}
	
	function setAlias($sAlias) 
	{
		return $this->sAlias = sAlias;
	}
	
	//-- Email
	
	function getEmail() 
	{
		return $this->sEmail;
	}
	
	function setEmail($sEmail) 
	{
		return $this->sEmail = sEmail;
	}
	
	//-- Foto
	
	function getFoto() 
	{
		return $this->sFoto;
	}
	
	function setFoto($sFoto) 
	{
		return $this->sFoto = sFoto;
	}
	
	//-- Password
	
	function getPassword() 
	{
		return $this->sPassword;
	}
	
	function setPassword($sPassword) 
	{
		return $this->sPassword = sPassword;
	}
	
	//-- Estado
	
	function getEstado() 
	{
		return $this->bEstado;
	}
	
	function setEstado($bEstado) 
	{
		return $this->bEstado = bEstado;
	}
}