<?php

class Comprador_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function update_carrito($params, $id_producto, $id_user)
    {

        $this->db->where('id_productos', $id_producto);
        $this->db->where('id_usuarios', $id_user);
        $this->db->update('tbl_carrito_deseos', $params);
    }

    public function add_carrito($params)
    {
        $this->db->insert('tbl_carrito_deseos', $params);
        // return $this->db->insert_id();
    }

    public function add_producto_compra($params)
    {
        $this->db->insert('tbl_productos_compras', $params);
        // return $this->db->insert_id();
    }

    public function add_compra($params)
    {
        $this->db->insert('tbl_compras', $params);
        return $this->db->insert_id();
    }

    function get_all_tiendas()
    {
        return $this->db->query("SELECT *
                                FROM tbl_usuarios
                                WHERE tbl_usuarios.tipo_usuario = 'Tienda'
                                and tbl_usuarios.denuncias < 10
                                ORDER BY tbl_usuarios.nombre_real ASC")->result_array();
    }

    function get_all_productos()
    {
        return $this->db->query("SELECT *
                                FROM tbl_productos
                                ")->result_array();
    }

    function get_all_premios($id_usuario)
    {
        return $this->db->query("SELECT * FROM tbl_premios WHERE tbl_premios.id_usuarios =$id_usuario and tbl_premios.estado = 'Activo'")->result_array();
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

    function search_categoriaT($data)
    {
        return $this->db->query("SELECT tbl_usuarios.*
                                FROM tbl_usuarios,tbl_productos,tbl_categorias
                                WHERE tbl_usuarios.tipo_usuario = 'Tienda'
                                AND tbl_productos.id_usuarios = tbl_usuarios.id_usuarios
                                AND tbl_productos.id_categorias = tbl_categorias.id_categorias
                                AND tbl_categorias.id_categorias = '$data'
                                GROUP BY tbl_usuarios.nombre_real
                                ORDER BY tbl_usuarios.nombre_real ASC")->result_array();
    }

    function search_categoria($data)
    {
        return $this->db->query("SELECT tbl_productos.*
                                FROM tbl_usuarios,tbl_productos,tbl_categorias
                                WHERE tbl_usuarios.tipo_usuario = 'Tienda'
                                AND tbl_productos.id_usuarios = tbl_usuarios.id_usuarios
                                AND tbl_productos.id_categorias = tbl_categorias.id_categorias
                                AND tbl_categorias.id_categorias = '$data' 
                                group by tbl_productos.descripcion
                                ORDER BY tbl_productos.descripcion ASC")->result_array();
    }

    function search_carrito_deseo($id_user, $id_producto, $tipo_producto)
    {
        return $this->db->query("SELECT * FROM tbl_carrito_deseos 
                                WHERE tbl_carrito_deseos.id_usuarios = $id_user
                                AND tbl_carrito_deseos.id_productos = $id_producto
                                AND tbl_carrito_deseos.tipo_producto = '$tipo_producto'")->row_array();
    }

    function get_all_carrito($id_usuario, $tipo_producto)
    {
        return $this->db->query("SELECT tbl_carrito_deseos.* FROM tbl_carrito_deseos, tbl_productos,tbl_usuarios
                                WHERE tbl_carrito_deseos.id_usuarios = $id_usuario
                                AND tbl_productos.id_productos = tbl_carrito_deseos.id_productos
                                AND tbl_productos.id_usuarios = tbl_usuarios.id_usuarios
                                and tbl_usuarios.denuncias < 10
                                AND tbl_carrito_deseos.tipo_producto = '$tipo_producto'")->result_array();
    }
    function get_all_carrito_deseo($id_usuario, $tipo_producto)
    {
        return $this->db->query("SELECT tbl_carrito_deseos.*,tbl_productos.* FROM tbl_carrito_deseos, tbl_productos
                                WHERE tbl_carrito_deseos.id_usuarios = $id_usuario
                                AND tbl_productos.id_productos = tbl_carrito_deseos.id_productos
                                AND tbl_carrito_deseos.tipo_producto = '$tipo_producto'")->result_array();
    }

    function get_direcciones($users_id)
    {
        return $this->db->query("SELECT tbl_direcciones.* FROM tbl_direcciones WHERE tbl_direcciones.id_usuarios = " . $users_id)->result_array();
    }

    function get_all_pago($id_usuario)
    {
        return $this->db->query("SELECT * from tbl_formas_pago WHERE tbl_formas_pago.id_usuarios = $id_usuario")->result_array();
    }


    public function get_pagoUnico($data)
    {
        $pagoExists = $this->get_informacion_pago($data['id_formas_pago']);

        //Se compara el password que viene por POST con el encriptado de la BD por medio de password_verify()
        if ($pagoExists != false && password_verify($data['cvv'], $pagoExists[0]->cvv)) {
            return true; //Existe: autenticado
        } else {
            return false; //No autenticado
        }
    }

    //Retorna los datos del usuario indicado por parámetro
    public function get_informacion_pago($id_formas_pago)
    {

        $query = $this->db->query("SELECT * FROM tbl_formas_pago 
             WHERE tbl_formas_pago.id_formas_pago=$id_formas_pago");

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_pagoUnicoTodo($id_pago)
    {
        return $this->db->query("SELECT * FROM tbl_formas_pago 
        WHERE tbl_formas_pago.id_formas_pago=$id_pago")->row_array();
    }




    function get_pagoId_pago($id_pago)
    {
        return $this->db->query("SELECT * FROM tbl_formas_pago 
        WHERE tbl_formas_pago.id_formas_pago=$id_pago ")->row_array();
    }

    public function delete_carrito($id, $tipo_producto)
    {
        $this->db->delete('tbl_carrito_deseos', array('id_productos' => $id, 'tipo_producto' => $tipo_producto));
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

    public function notificaionesComprador($id)
    {
        $query = $this->db->query("SELECT u.* FROM tbl_notificaciones u where u.id_usuarios = $id AND u.estado='N'");
        return $query->result_array();
    }

    public function addNotificacionesTienda($params)
    {
        $this->db->insert('tbl_notificaciones', $params);
        return $this->db->insert_id();
    }

    public function ocultarNotificacion($id)
    {
        $this->db->where('id_notificaciones', $id);
        $this->db->update('tbl_notificaciones', array('estado' => 'S'));
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
    function get_calificaciones_productos($id)
    {
        return $this->db->query("SELECT *
                                FROM tbl_calificacion_productos
                                where tbl_calificacion_productos.id_productos= " . $id)->result_array();
    }
    function get_calificacion_producto_usuarioId($id_producto, $id_usuario)
    {
        return $this->db->query("SELECT *
                                FROM tbl_calificacion_productos
                                where tbl_calificacion_productos.id_productos=$id_producto 
                                and tbl_calificacion_productos.id_usuarios=$id_usuario")->result_array();
    }

    public function calificarProducto($params)
    {
        $this->db->insert('tbl_calificacion_productos', $params);
        return $this->db->insert_id();
    }

    public function actualizarCalificarProducto($params, $id_producto, $id_user)
    {

        $this->db->where('id_productos', $id_producto);
        $this->db->where('id_usuarios', $id_user);
        $this->db->update('tbl_calificacion_productos', $params);
    }

    public function editProducto($params, $id)
    {
        $this->db->where('id_productos', $id);
        $this->db->update('tbl_productos', $params);
    }

    public function get_productoUnico($id)
    {
        return $this->db->query("SELECT * FROM tbl_productos WHERE tbl_productos.id_productos=$id")->row_array();
    }

    public function comprarProducto($id)
    {
        return $this->db->query("SELECT * FROM tbl_productos WHERE tbl_productos.id_productos=$id")->row_array();
    }

    public function editMonto($params, $id_pago)
    {
        $this->db->where('id_formas_pago', $id_pago);
        $this->db->update('tbl_formas_pago', $params);
    }

    function get_productos_mas_vendidos()
    {
        return $this->db->query("SELECT  tbl_productos_compras.id_productos, SUM(tbl_productos_compras.cantidades)
                                FROM tbl_productos_compras
                                GROUP BY tbl_productos_compras.id_productos
                                ORDER BY SUM(tbl_productos_compras.cantidades) DESC
                                LIMIT 3")->result_array();
    }
    public function insertPremio($params)
    {
        $this->db->insert('tbl_premios', $params);
        return $this->db->insert_id();
    }
    public function getCompra($id)
    {
        $query = $this->db->query("SELECT u.*,c.*,d.*,s.*,t.* FROM tbl_compras u JOIN tbl_usuarios c ON c.id_usuarios=u.id_usuarios JOIN tbl_direcciones d ON d.id_direcciones=u.id_direcciones JOIN tbl_formas_pago s ON s.id_formas_pago=u.id_formas_pago left JOIN tbl_premios t ON t.id_premios = u.id_premios  where u.id_compras = $id");
        return $query->row_array();
    }

    public function getCompras($id)
    {
        $query = $this->db->query("SELECT u.* FROM tbl_compras u where u.id_usuarios = $id");
        return $query->result_array();
    }
    public function getProductosCompra($id)
    {
        $query = $this->db->query("SELECT u.*,p.*,s.*,c.* FROM tbl_productos_compras u JOIN tbl_productos p ON u.id_productos=p.id_productos JOIN tbl_usuarios s ON s.id_usuarios = p.id_usuarios JOIN tbl_categorias c ON c.id_categorias = p.id_categorias where u.id_compras = $id");
        return $query->result_array();
    }

    public function editPremio($params, $id_premio)
    {
        $this->db->where('id_premios', $id_premio);
        $this->db->update('tbl_premios', $params);
    }
    
    public function get_Count_denuncias(){
        $query = $this->db->query("SELECT COUNT(*) as cantidad,tbl_denuncias.tienda_id_usuarios FROM tbl_denuncias GROUP BY tbl_denuncias.tienda_id_usuarios");
        return $query->result_array();
    }
}
