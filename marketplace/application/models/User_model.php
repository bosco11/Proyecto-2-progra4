<?php
class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_user($users_id)
    {
        return $this->db->query("SELECT tbl_usuarios.* FROM tbl_usuarios WHERE tbl_usuarios.id_usuarios = " . $users_id)->row_array();
    }

    function add_user($params)
    {
        $this->db->insert('tbl_usuarios', $params);
        return $this->db->insert_id();
    }

    function update_user($users_id, $params)
    {
        $this->db->where('id_usuarios', $users_id);
        return $this->db->update('tbl_usuarios', $params);
    }

    function delete_user($users_id)
    {
        return $this->db->delete('tbl_usuarios', array('id_usuarios' => $users_id));
    }
    

    function get_red_social($users_id)
    {
        return $this->db->query("SELECT tbl_redes_sociales.* FROM tbl_redes_sociales WHERE tbl_redes_sociales.id_usuarios = " . $users_id)->result_array();
    }
    function get_red($red_id)
    {
        return $this->db->query("SELECT tbl_redes_sociales.* FROM tbl_redes_sociales WHERE tbl_redes_sociales.id_redes_sociales = " . $red_id)->row_array();
    }
    function add_red($params)
    {
        $this->db->insert('tbl_redes_sociales', $params);
        return $this->db->insert_id();
    }
    function delete_red($red_id)
    {
        return $this->db->delete('tbl_redes_sociales', array('id_redes_sociales' => $red_id));
    }
    function update_red($red_id, $params)
    {
        $this->db->where('id_redes_sociales', $red_id);
        return $this->db->update('tbl_redes_sociales', $params);
    }



    function get_directions($users_id)
    {
        return $this->db->query("SELECT tbl_direcciones.* FROM tbl_direcciones WHERE tbl_direcciones.id_usuarios = " . $users_id)->result_array();
    }
    function get_direction($dir_id)
    {
        return $this->db->query("SELECT tbl_direcciones.* FROM tbl_direcciones WHERE tbl_direcciones.id_direcciones = " . $dir_id)->row_array();
    }
    function add_direction($params)
    {
        $this->db->insert('tbl_direcciones', $params);
        return $this->db->insert_id();
    }
    function delete_direction($dir_id)
    {
        return $this->db->delete('tbl_direcciones', array('id_direcciones' => $dir_id));
    }
    function update_direction($dir_id, $params)
    {
        $this->db->where('id_direcciones', $dir_id);
        return $this->db->update('tbl_direcciones', $params);
    }


    function get_forms_pay($users_id)
    {
        return $this->db->query("SELECT tbl_formas_pago.* FROM tbl_formas_pago WHERE tbl_formas_pago.id_usuarios = " . $users_id)->result_array();
    }
    function get_form_pay($pay_id)
    {
        return $this->db->query("SELECT tbl_formas_pago.* FROM tbl_formas_pago WHERE tbl_formas_pago.id_formas_pago = " . $pay_id)->row_array();
    }
    function add_pay($params)
    {
        $this->db->insert('tbl_formas_pago', $params);
        return $this->db->insert_id();
    }
    function delete_pay($pay_id)
    {
        return $this->db->delete('tbl_formas_pago', array('id_formas_pago' => $pay_id));
    }
    function update_pay($pay_id, $params)
    {
        $this->db->where('id_formas_pago', $pay_id);
        return $this->db->update('tbl_formas_pago', $params);
    }

    public function getTiendas_Suscritas($id)
	{
		$query = $this->db->query("SELECT u.*, c.* FROM tbl_suscriptores u JOIN tbl_usuarios c ON c.id_usuarios=u.tienda_id_usuarios where u.comprador_id_usuarios = $id");
		return $query->result_array();
	}
}
