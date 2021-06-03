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


    function get_directions($users_id)
    {
        return $this->db->query("SELECT tbl_direcciones.* FROM tbl_direcciones WHERE tbl_direcciones.id_usuarios = " . $users_id)->result_array();
    }
    function get_forms_pay($users_id)
    {
        return $this->db->query("SELECT tbl_formas_pago.* FROM tbl_formas_pago WHERE tbl_formas_pago.id_usuarios = " . $users_id)->result_array();
    }
    function get_red_social($users_id)
    {
        return $this->db->query("SELECT tbl_redes_sociales.* FROM tbl_redes_sociales WHERE tbl_redes_sociales.id_usuarios = " . $users_id)->result_array();
    }
}
