<?php
class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
   //Retorna los datos del usuario indicado por parámetro
    function get_user($users_id)
    {
        return $this->db->query("SELECT tbl_usuarios.* FROM tbl_usuarios WHERE tbl_usuarios.id_usuarios = " . $users_id)->row_array();
    }
    //Se ingresa un usuario a la bd
    function add_user($params)
    {
        $this->db->insert('tbl_usuarios', $params);
        return $this->db->insert_id();
    }
    //Se actualiza un usuario
    function update_user($users_id, $params)
    {
        $this->db->where('id_usuarios', $users_id);
        return $this->db->update('tbl_usuarios', $params);
    }
    // Se elimina un asuario
    function delete_user($users_id)
    {
        return $this->db->delete('tbl_usuarios', array('id_usuarios' => $users_id));
    }
    
    // Se actualiza una red social
    function get_red_social($users_id)
    {
        return $this->db->query("SELECT tbl_redes_sociales.* FROM tbl_redes_sociales WHERE tbl_redes_sociales.id_usuarios = " . $users_id)->result_array();
    }
    // Se obtiene las redes sociales con los parametros indicaos 
    function get_red($red_id)
    {
        return $this->db->query("SELECT tbl_redes_sociales.* FROM tbl_redes_sociales WHERE tbl_redes_sociales.id_redes_sociales = " . $red_id)->row_array();
    }
        //Se agrega una red social a la BD
    function add_red($params)
    {
        $this->db->insert('tbl_redes_sociales', $params);
        return $this->db->insert_id();
    }
    // Se elimina una red social
    function delete_red($red_id)
    {
        return $this->db->delete('tbl_redes_sociales', array('id_redes_sociales' => $red_id));
    }
    // Se actualiza una red social
    function update_red($red_id, $params)
    {
        $this->db->where('id_redes_sociales', $red_id);
        return $this->db->update('tbl_redes_sociales', $params);
    }


    // Se obtienen direcciones con los parametros indicados
    function get_directions($users_id)
    {
        return $this->db->query("SELECT tbl_direcciones.* FROM tbl_direcciones WHERE tbl_direcciones.id_usuarios = " . $users_id)->result_array();
    }
    // Se obtiene una direccion con los parametros indicados
    function get_direction($dir_id)
    {
        return $this->db->query("SELECT tbl_direcciones.* FROM tbl_direcciones WHERE tbl_direcciones.id_direcciones = " . $dir_id)->row_array();
    }
    // Se agrega una direccion a la BD
    function add_direction($params)
    {
        $this->db->insert('tbl_direcciones', $params);
        return $this->db->insert_id();
    }
    // Se elimina una direccion de la BD
    function delete_direction($dir_id)
    {
        return $this->db->delete('tbl_direcciones', array('id_direcciones' => $dir_id));
    }
    // Se actualiza una direccion 
    function update_direction($dir_id, $params)
    {
        $this->db->where('id_direcciones', $dir_id);
        return $this->db->update('tbl_direcciones', $params);
    }

    // Se obtiene las formas de pagos
    function get_forms_pay($users_id)
    {
        return $this->db->query("SELECT tbl_formas_pago.* FROM tbl_formas_pago WHERE tbl_formas_pago.id_usuarios = " . $users_id)->result_array();
    }
    // Se obtiene una forma de pago
    function get_form_pay($pay_id)
    {
        return $this->db->query("SELECT tbl_formas_pago.* FROM tbl_formas_pago WHERE tbl_formas_pago.id_formas_pago = " . $pay_id)->row_array();
    }
    // Se agrega una forma de pago 
    function add_pay($params)
    {
        $this->db->insert('tbl_formas_pago', $params);
        return $this->db->insert_id();
    }
    // Se elimina una forma de pago
    function delete_pay($pay_id)
    {
        return $this->db->delete('tbl_formas_pago', array('id_formas_pago' => $pay_id));
    }
    // Se actauliza una forma de pago
    function update_pay($pay_id, $params)
    {
        $this->db->where('id_formas_pago', $pay_id);
        return $this->db->update('tbl_formas_pago', $params);
    }
    // Se obtienen las tiendas suscritas de un usuario 
    public function getTiendas_Suscritas($id)
	{
		$query = $this->db->query("SELECT u.*, c.* FROM tbl_suscriptores u JOIN tbl_usuarios c ON c.id_usuarios=u.tienda_id_usuarios where u.comprador_id_usuarios = $id");
		return $query->result_array();
	}
}
