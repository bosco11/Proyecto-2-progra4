<?php

class Comprador_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function update_carrito($params, $id_producto, $id_user)//edita el tipo del carrito , si es deseo o si es carrito
    {

        $this->db->where('id_productos', $id_producto);
        $this->db->where('id_usuarios', $id_user);
        $this->db->update('tbl_carrito_deseos', $params);
    }

    public function add_carrito($params)//agrega al carrito_deseo con la letra C de carrio o D de deseo
    {
        $this->db->insert('tbl_carrito_deseos', $params);
        // return $this->db->insert_id();
    }

    public function add_producto_compra($params)//agrega a a tabla producto compra despues de realizar la compra para la factura
    {
        $this->db->insert('tbl_productos_compras', $params);
        // return $this->db->insert_id();
    }

    public function add_compra($params)//agrega una compra
    {
        $this->db->insert('tbl_compras', $params);
        return $this->db->insert_id();
    }

    function get_all_tiendas() //trae todas las tiendas de base de datos que tengan menos de 10 denuncias
    {
        return $this->db->query("SELECT *
                                FROM tbl_usuarios
                                WHERE tbl_usuarios.tipo_usuario = 'Tienda'
                                and tbl_usuarios.denuncias < 10
                                ORDER BY tbl_usuarios.nombre_real ASC")->result_array();
    }

    function get_all_productos() //trae todos los productos
    {
        return $this->db->query("SELECT *
                                FROM tbl_productos
                                ")->result_array();
    }

    function get_all_premios($id_usuario) //trae todos los productos
    {
        return $this->db->query("SELECT * FROM tbl_premios WHERE tbl_premios.id_usuarios =$id_usuario and tbl_premios.estado = 'Activo'")->result_array();
    }


    function get_all_galerias() //trae todas las fotos
    {
        return $this->db->query("SELECT *
                                FROM tbl_galeria
                                ")->result_array();
    }

    function search_tiendas($data) //trae todas las tiendas con la informacion que ingresa el usuario con menos de 10 denuncias
    {
        return $this->db->query("SELECT *
                                FROM tbl_usuarios
                                WHERE tbl_usuarios.tipo_usuario = 'Tienda'
                                AND tbl_usuarios.nombre_real LIKE '%" .$data. "%'
                                AND tbl_usuarios.denuncias < 10
                                ORDER BY tbl_usuarios.nombre_real ASC")->result_array();
    }

    function search_categoriaT($data)//trae todas las tiendas , segun el combobox que selecciona el usuario de categorias con menos de 10 denuncias
    {
        return $this->db->query("SELECT tbl_usuarios.*
                                FROM tbl_usuarios,tbl_productos,tbl_categorias
                                WHERE tbl_usuarios.tipo_usuario = 'Tienda'
                                AND tbl_productos.id_usuarios = tbl_usuarios.id_usuarios
                                AND tbl_productos.id_categorias = tbl_categorias.id_categorias
                                AND tbl_categorias.id_categorias = '$data'
                                AND tbl_usuarios.denuncias < 10 
                                GROUP BY tbl_usuarios.nombre_real
                                ORDER BY tbl_usuarios.nombre_real ASC")->result_array();
    }

    function search_categoria($data)//trae todos los productos con la iformacion que el usuario ingreso
    {
        return $this->db->query("SELECT tbl_productos.*
                                FROM tbl_usuarios,tbl_productos,tbl_categorias
                                WHERE tbl_usuarios.tipo_usuario = 'Tienda'
                                AND tbl_productos.id_usuarios = tbl_usuarios.id_usuarios
                                AND tbl_productos.id_categorias = tbl_categorias.id_categorias
                                AND tbl_categorias.id_categorias = '$data'
                                AND tbl_usuarios.denuncias < 10 
                                group by tbl_productos.descripcion
                                ORDER BY tbl_productos.descripcion ASC")->result_array();
    }

    function search_carrito_deseo($id_user, $id_producto, $tipo_producto)//filtra todo lo del carrito o lo de la lista de deseo segun el usuario ingresado 
    {
        return $this->db->query("SELECT * FROM tbl_carrito_deseos 
                                WHERE tbl_carrito_deseos.id_usuarios = $id_user
                                AND tbl_carrito_deseos.id_productos = $id_producto
                                AND tbl_carrito_deseos.tipo_producto = '$tipo_producto'")->row_array();
    }

    function get_all_carrito($id_usuario, $tipo_producto)//trae todo lo del carrito segun el usuario ingresado 
    {
        return $this->db->query("SELECT tbl_carrito_deseos.* FROM tbl_carrito_deseos, tbl_productos,tbl_usuarios
                                WHERE tbl_carrito_deseos.id_usuarios = $id_usuario
                                AND tbl_productos.id_productos = tbl_carrito_deseos.id_productos
                                AND tbl_productos.id_usuarios = tbl_usuarios.id_usuarios
                                and tbl_usuarios.denuncias < 10
                                AND tbl_carrito_deseos.tipo_producto = '$tipo_producto'")->result_array();
    }
    function get_all_carrito_deseo($id_usuario, $tipo_producto)//trae todos lo del carrito o lo de la lista de deseo segun el usuario ingresado 
    {
        return $this->db->query("SELECT tbl_carrito_deseos.*,tbl_productos.* FROM tbl_carrito_deseos, tbl_productos
                                WHERE tbl_carrito_deseos.id_usuarios = $id_usuario
                                AND tbl_productos.id_productos = tbl_carrito_deseos.id_productos
                                AND tbl_carrito_deseos.tipo_producto = '$tipo_producto'")->result_array();
    }

    function get_direcciones($users_id)//trae todas las direcciones de un usuario
    {
        return $this->db->query("SELECT tbl_direcciones.* FROM tbl_direcciones WHERE tbl_direcciones.id_usuarios = " . $users_id)->result_array();
    }

    function get_all_pago($id_usuario)//trae todos los metodos de pago de un usuario
    {
        return $this->db->query("SELECT * from tbl_formas_pago WHERE tbl_formas_pago.id_usuarios = $id_usuario")->result_array();
    }


    public function get_pagoUnico($data)//trae un metodo de pago y comprueba que el cvv son iguales al de base de datos
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

    function get_pagoUnicoTodo($id_pago)//trae todos los metodos de pago
    {
        return $this->db->query("SELECT * FROM tbl_formas_pago 
        WHERE tbl_formas_pago.id_formas_pago=$id_pago")->row_array();
    }




    function get_pagoId_pago($id_pago)//trae todos los metodos de pago
    {
        return $this->db->query("SELECT * FROM tbl_formas_pago 
        WHERE tbl_formas_pago.id_formas_pago=$id_pago ")->row_array();
    }

    public function delete_carrito($id, $tipo_producto)//elimina de la tabla carrito_deseos por el id del producto y por el tipo
    {
        $this->db->delete('tbl_carrito_deseos', array('id_productos' => $id, 'tipo_producto' => $tipo_producto));
    }

    function search_productoT($data)//filra por nombre que ingresa el usuario los producto
    {
        return $this->db->query("SELECT tbl_usuarios.*
                                FROM tbl_usuarios,tbl_productos
                                WHERE tbl_usuarios.tipo_usuario = 'Tienda'
                                AND tbl_productos.id_usuarios = tbl_usuarios.id_usuarios
                                AND tbl_productos.descripcion LIKE '%" .$data. "%'
                                AND tbl_usuarios.denuncias < 10
                                GROUP BY tbl_usuarios.nombre_real
                                ORDER BY tbl_usuarios.nombre_real ASC")->result_array();
    }

    public function notificaionesComprador($id)//trae todas las notificaciones del usuario que no se hayan visto
    {
        $query = $this->db->query("SELECT u.* FROM tbl_notificaciones u where u.id_usuarios = $id AND u.estado='N'");
        return $query->result_array();
    }

    public function addNotificacionesTienda($params)//se agregan notificaciones
    {
        $this->db->insert('tbl_notificaciones', $params);
        return $this->db->insert_id();
    }

    public function ocultarNotificacion($id)//se les cambia el estado de las notificaciones
    {
        $this->db->where('id_notificaciones', $id);
        $this->db->update('tbl_notificaciones', array('estado' => 'S'));
    }

    function search_producto($data)//filtra por el nombre del produto que el usuario ingresa
    {
        return $this->db->query("SELECT tbl_productos.*
                                FROM tbl_usuarios,tbl_productos
                                WHERE tbl_usuarios.tipo_usuario = 'Tienda'
                                AND tbl_productos.id_usuarios = tbl_usuarios.id_usuarios
                                AND tbl_productos.descripcion LIKE '%" .$data ."%'
                                AND tbl_usuarios.denuncias < 10
                                group by tbl_productos.descripcion
                                ORDER BY tbl_productos.descripcion ASC")->result_array();
    }

    function get_all_categorias()//trae todas las categorias 
    {
        return $this->db->get('tbl_categorias')->result_array();
    }

    function get_producto_id($prod_id)//trea el producto, las calificaciones, los usuarios y categorias con el id de un producto
    {
        return $this->db->query("SELECT p.*, ca.*, u.*,c.*
        FROM tbl_productos p 
        left join tbl_calificacion_productos ca on ca.id_productos=p.id_productos
        join tbl_usuarios u on u.id_usuarios=p.id_usuarios
        join tbl_categorias c on c.id_categorias=p.id_categorias 
        WHERE p.id_productos = " . $prod_id)->row_array();
    }
    function get_galerias($id)//trae todas las fotos de la galeria de un producto
    {
        return $this->db->query("SELECT *
                                FROM tbl_galeria
                                where tbl_galeria.id_productos= " . $id)->result_array();
    }
    function get_calificaciones_productos($id)//trae todas las calificaciones con el id de un producto
    {
        return $this->db->query("SELECT *
                                FROM tbl_calificacion_productos
                                where tbl_calificacion_productos.id_productos= " . $id)->result_array();
    }
    function get_calificacion_producto_usuarioId($id_producto, $id_usuario)//trae todas las calificaciones con el id de un producto y un id de un usaurio
    {
        return $this->db->query("SELECT *
                                FROM tbl_calificacion_productos
                                where tbl_calificacion_productos.id_productos=$id_producto 
                                and tbl_calificacion_productos.id_usuarios=$id_usuario")->result_array();
    }

    public function calificarProducto($params)//se inserta la calificacion de un producto
    {
        $this->db->insert('tbl_calificacion_productos', $params);
        return $this->db->insert_id();
    }

    public function actualizarCalificarProducto($params, $id_producto, $id_user)//se actualiza la calificacion de un producto
    {

        $this->db->where('id_productos', $id_producto);
        $this->db->where('id_usuarios', $id_user);
        $this->db->update('tbl_calificacion_productos', $params);
    }

    public function editProducto($params, $id)//se edita el producto
    {
        $this->db->where('id_productos', $id);
        $this->db->update('tbl_productos', $params);
    }

    public function get_productoUnico($id)//se trae un producto en especifico con el id del producto
    {
        return $this->db->query("SELECT * FROM tbl_productos WHERE tbl_productos.id_productos=$id")->row_array();
    }

    public function comprarProducto($id)
    {
        return $this->db->query("SELECT * FROM tbl_productos WHERE tbl_productos.id_productos=$id")->row_array();
    }

    public function editMonto($params, $id_pago)//edita el monto del metodo de pago
    {
        $this->db->where('id_formas_pago', $id_pago);
        $this->db->update('tbl_formas_pago', $params);
    }

    function get_productos_mas_vendidos()//se trae los 3 productos mas vendidos segun la tabla productos_compras, las cuales esos productos las tiendas tiene que tener menos de 10 denuncias
    {
        return $this->db->query("SELECT  tbl_productos_compras.id_productos, SUM(tbl_productos_compras.cantidades)
                                FROM tbl_productos_compras,tbl_usuarios,tbl_productos
                                WHERE tbl_productos.id_productos = tbl_productos_compras.id_productos
                                AND tbl_productos.id_usuarios = tbl_usuarios.id_usuarios
                                AND tbl_usuarios.denuncias < 10
                                GROUP BY tbl_productos_compras.id_productos
                                ORDER BY SUM(tbl_productos_compras.cantidades) DESC
                                LIMIT 3")->result_array();
    }
    public function insertPremio($params)//inserta un premio
    {
        $this->db->insert('tbl_premios', $params);
        return $this->db->insert_id();
    }
    public function getCompra($id)//trae la compra
    {
        $query = $this->db->query("SELECT u.*,c.*,d.*,s.*,t.* FROM tbl_compras u JOIN tbl_usuarios c ON c.id_usuarios=u.id_usuarios JOIN tbl_direcciones d ON d.id_direcciones=u.id_direcciones JOIN tbl_formas_pago s ON s.id_formas_pago=u.id_formas_pago left JOIN tbl_premios t ON t.id_premios = u.id_premios  where u.id_compras = $id");
        return $query->row_array();
    }

    public function getCompras($id)//trae las compras realizadas
    {
        $query = $this->db->query("SELECT u.* FROM tbl_compras u where u.id_usuarios = $id");
        return $query->result_array();
    }
    public function getProductosCompra($id)
    {
        $query = $this->db->query("SELECT u.*,p.*,s.*,c.* FROM tbl_productos_compras u JOIN tbl_productos p ON u.id_productos=p.id_productos JOIN tbl_usuarios s ON s.id_usuarios = p.id_usuarios JOIN tbl_categorias c ON c.id_categorias = p.id_categorias where u.id_compras = $id");
        return $query->result_array();
    }

    public function editPremio($params, $id_premio)//edita el premio
    {
        $this->db->where('id_premios', $id_premio);
        $this->db->update('tbl_premios', $params);
    }

    public function get_Count_denuncias()//cuenta las denuncias que tiene las tiendas 
    {
        $query = $this->db->query("SELECT COUNT(*) as cantidad,tbl_denuncias.tienda_id_usuarios FROM tbl_denuncias GROUP BY tbl_denuncias.tienda_id_usuarios");
        return $query->result_array();
    }
}
