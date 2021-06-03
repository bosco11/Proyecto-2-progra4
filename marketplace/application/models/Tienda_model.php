<?php

Class Tienda_model extends CI_Model {

	//Se utiliza el algoritmo de encriptación nativo de PHP password_hash('contraseña', PASSWORD_BCRYPT) para encriptar.
	//Para verificar la contraseña se utiliza password_verify('contraseña','passw de la BD')
	public function get_productos_tienda($id) {
        $query = $this->db->query("SELECT u.*,c.categorias FROM tbl_productos u JOIN tbl_categorias c ON c.id_categorias=u.id_categorias where u.id_usuarios = $id");
		return $query->result_array();
		
    }
	//Retorna los datos del usuario indicado por parámetro
	public function get_user_information($username) {

		$query = $this->db->query("SELECT u.* FROM tbl_usuarios u where u.user = '$username'");

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
    public function get_productos_id($id) {
        $query = $this->db->query("SELECT u.*,c.categorias FROM tbl_productos u JOIN tbl_categorias c ON c.id_categorias=u.id_categorias where u.id_productos = $id");
        if ($query->num_rows() == 1) {
			return $query->result_array();
		} else {
			return false;
		}
		
		
    }
    public function get_elimnar_producto($id){
        $this->db->delete('tbl_productos', array('id_productos' => $id));
    }
	public function get_categorias(){
        return $this->db->get('tbl_categorias')->result_array();
    }
	public function addProducto($params){
		$this->db->insert('tbl_productos',$params);
        return $this->db->insert_id();
	}
	public function editProducto($params,$id){
		$this->db->where('id_productos', $id);
        $this->db->update('tbl_productos', $params);
	}


}