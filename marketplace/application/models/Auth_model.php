<?php

class Auth_model extends CI_Model
{

	//Se utiliza el algoritmo de encriptación nativo de PHP password_hash('contraseña', PASSWORD_BCRYPT) para encriptar.
	//Para verificar la contraseña se utiliza password_verify('contraseña','passw de la BD')
	public function login($data)
	{
		$userExists = $this->get_user_information($data['user']);

		//Se compara el password que viene por POST con el encriptado de la BD por medio de password_verify()
		if ($userExists != false && password_verify($data['password'], $userExists[0]->password)) {
			return true; //Existe: autenticado
		} else {
			return false; //No autenticado
		}
	}

	//Retorna los datos del usuario indicado por parámetro
	public function get_user_information($username)
	{

		$query = $this->db->query("SELECT u.* FROM tbl_usuarios u where u.user = '$username'");

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
}
