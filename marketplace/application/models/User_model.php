<?php
class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_user($users_id)
    {
        return $this->db->query("SELECT tbl_usuarios* FROM tbl_usuarios WHERE tbl_usuarios.id_usuarios = " . $users_id)->row_array();
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
}
