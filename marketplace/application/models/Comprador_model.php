<?php

class Comprador_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_all_tiendas()
    {
        return $this->db->query("SELECT *
                                FROM tbl_usuarios
                                WHERE tbl_usuarios.tipo_usuario = 'Tienda'
                                ORDER BY tbl_usuarios.nombre_real ASC")->result_array();
    }

    function get_all_productos()
    {
        return $this->db->query("SELECT *
                                FROM tbl_productos
                                ")->result_array();
    }


    function get_all_galerias()
    {
        return $this->db->query("SELECT *
                                FROM tbl_galeria
                                ")->result_array();
    }

    function search_tiendas($data)
    {
        return $this->db->query("SELECT *
                                FROM tbl_usuarios
                                WHERE tbl_usuarios.tipo_usuario = 'Tienda'
                                 AND tbl_usuarios.nombre_real LIKE '%" . $data . "%'
                                 ORDER BY tbl_usuarios.nombre_real ASC")->result_array();
    }

    function search_categoria($data)
    {
        return $this->db->query("SELECT tbl_usuarios.*
                                FROM tbl_usuarios,tbl_productos,tbl_categorias
                                WHERE tbl_usuarios.tipo_usuario = 'Tienda' 
                                AND tbl_productos.id_usuarios = tbl_usuarios.id_usuarios
                                AND tbl_productos.id_categorias = tbl_categorias.id_categorias
                                AND tbl_categorias.id_categorias = '$data'
                                group by tbl_usuarios.nombre_real
                                ORDER BY tbl_usuarios.nombre_real ASC")->result_array();
    }

    function search_producto($data)
    {
        return $this->db->query("SELECT *
                                FROM tbl_usuarios,tbl_productos
                                WHERE tbl_usuarios.tipo_usuario = 'Tienda'
                                AND tbl_productos.id_usuarios = tbl_usuarios.id_usuarios
                                AND tbl_productos.descripcion LIKE '%" . $data . "%'
                                ORDER BY tbl_usuarios.nombre_real ASC")->result_array();
    }

    function get_all_categorias()
    {
        return $this->db->get('tbl_categorias')->result_array();
    }
}
