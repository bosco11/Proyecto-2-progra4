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

    function search_productoT($data)
    {
        return $this->db->query("SELECT tbl_usuarios.*
                                FROM tbl_usuarios,tbl_productos
                                WHERE tbl_usuarios.tipo_usuario = 'Tienda'
                                AND tbl_productos.id_usuarios = tbl_usuarios.id_usuarios
                                AND tbl_productos.descripcion LIKE '%" . $data . "%'
                                GROUP BY tbl_usuarios.nombre_real
                                ORDER BY tbl_usuarios.nombre_real ASC")->result_array();
    }



    function search_producto($data)
    {
        return $this->db->query("SELECT tbl_productos.*
                                FROM tbl_usuarios,tbl_productos
                                WHERE tbl_usuarios.tipo_usuario = 'Tienda'
                                AND tbl_productos.id_usuarios = tbl_usuarios.id_usuarios
                                AND tbl_productos.descripcion LIKE '%" . $data . "%'
                                group by tbl_productos.descripcion
                                ORDER BY tbl_productos.descripcion ASC")->result_array();
    }

    function get_all_categorias()
    {
        return $this->db->get('tbl_categorias')->result_array();
    }

    function get_producto_id($prod_id)
    {
        return $this->db->query("SELECT p.*, ca.*, u.*,c.*
        FROM tbl_productos p 
        left join tbl_calificacion_productos ca on ca.id_productos=p.id_productos
        join tbl_usuarios u on u.id_usuarios=p.id_usuarios
        join tbl_categorias c on c.id_categorias=p.id_categorias 
        WHERE p.id_productos = " . $prod_id)->row_array();
    }
    function get_galerias($id)
    {
        return $this->db->query("SELECT *
                                FROM tbl_galeria
                                where tbl_galeria.id_productos= " . $id)->result_array();
    }
}
