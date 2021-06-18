<?php

class Tienda_model extends CI_Model
{

	public function get_productos_tienda($id) //Retorna todo los prodcutos de una tienda
	{
		$query = $this->db->query("SELECT u.*,c.categorias FROM tbl_productos u JOIN tbl_categorias c ON c.id_categorias=u.id_categorias where u.id_usuarios = $id");
		return $query->result_array();
	}
	function get_all_tiendas() //Retorna todas tiendas existentes en la aplicacion, que no esten denunciadas.
	{
		return $this->db->query("SELECT * FROM tbl_usuarios WHERE tbl_usuarios.tipo_usuario = 'Tienda' AND tbl_usuarios.denuncias < 10 ")->result_array();
	}
	public function get_productos_id($id) //Retorna todos los datos de un prudcto en expecifico.
	{
		$query = $this->db->query("SELECT u.*,c.categorias FROM tbl_productos u JOIN tbl_categorias c ON c.id_categorias=u.id_categorias where u.id_productos = $id");
		if ($query->num_rows() == 1) {
			return $query->result_array();
		} else {
			return false;
		}
	}
	public function get_elimnar_producto($id) // Elimina un producto en expecifico.
	{
		return $this->db->delete('tbl_productos', array('id_productos' => $id));
	}
	public function get_categorias() // Retorna todas la categorias del sistema.
	{
		return $this->db->get('tbl_categorias')->result_array();
	}
	public function get_categorias_id($id) // Retorna una categoria en espexifico.
	{
		$this->db->where('id_categorias', $id);
		return $this->db->get('tbl_categorias')->row_array();
	}
	public function addCategoria($params) // Crea una categoria
	{
		return $this->db->insert('tbl_categorias', $params);
	}

	public function editCategoria($id, $params) // Edita una categoria
	{
		$this->db->where('id_categorias', $id);
		return $this->db->update('tbl_categorias', $params);
	}
	public function addProducto($params) // Crea una categoria
	{
		$this->db->insert('tbl_productos', $params);
		return $this->db->insert_id();
	}
	public function editProducto($params, $id) // Edita un producto
	{
		$this->db->where('id_productos', $id);
		$this->db->update('tbl_productos', $params);
	}
	public function addFotoProducto($params) // Guarda una foto nueva de un producto.
	{

		$this->db->insert('tbl_galeria', $params);
		return $this->db->insert_id();
	}
	public function getFotosProducto($id) // Retorna todas las fotos de un producto.
	{
		$this->db->where('id_productos', $id);
		return $this->db->get('tbl_galeria')->result_array();
	}
	public function deleteFoto($id) // Elimina una foto de un producto.
	{
		$this->db->delete('tbl_galeria', array('id_galeria' => $id));
	}
	public function buscarProductos($id, $categoria, $descripcion) // Retorna los productos filtrados ya sea por categoria o por descripcion, hasta ambos.
	{
		if ($descripcion != null and $categoria == null) {
			$query = $this->db->query("SELECT u.*,c.categorias FROM tbl_productos u JOIN tbl_categorias c ON c.id_categorias=u.id_categorias where u.id_usuarios = $id AND u.descripcion LIKE '$descripcion%'");
		} else {
			if ($descripcion == null and $categoria != null) {
				$query = $this->db->query("SELECT u.*,c.categorias FROM tbl_productos u JOIN tbl_categorias c ON c.id_categorias=u.id_categorias where u.id_usuarios = $id AND u.id_categorias = " . $categoria);
			} else {
				if ($descripcion != null and $categoria != null) {
					$query = $this->db->query("SELECT u.*,c.categorias FROM tbl_productos u JOIN tbl_categorias c ON c.id_categorias=u.id_categorias where u.id_usuarios = $id AND u.descripcion LIKE '$descripcion%' AND u.id_categorias = $categoria");
				}
			}
		}

		return $query->result_array();
	}
	public function buscarProductosOfertas($id, $categoria, $fechaInicial, $fechaFinal, $precioMax) // Retorna los productos filtrados ya sea por categoria o rango de fechas o por precio, hasta pueden ser combinados.
	{
		$query = null;
		if ($fechaFinal != null and $fechaInicial != null and $categoria == null and $precioMax != null) {
			$query = $this->db->query("SELECT u.*,c.categorias FROM tbl_productos u JOIN tbl_categorias c ON c.id_categorias=u.id_categorias where u.id_usuarios = $id AND u.precio < $precioMax AND u.fecha_publicacion BETWEEN '$fechaInicial' AND '$fechaFinal'");
		} else {
			if ($fechaFinal == null and $fechaInicial == null and $categoria != null and $precioMax != null) {
				$query = $this->db->query("SELECT u.*,c.categorias FROM tbl_productos u JOIN tbl_categorias c ON c.id_categorias=u.id_categorias where u.id_usuarios = $id AND u.precio < $precioMax AND u.id_categorias = " . $categoria);
			} else {
				if ($fechaFinal != null  and $fechaInicial != null and $categoria != null and $precioMax != null) {
					$query = $this->db->query("SELECT u.*,c.categorias FROM tbl_productos u JOIN tbl_categorias c ON c.id_categorias=u.id_categorias where u.id_usuarios = $id AND u.precio < $precioMax AND u.fecha_publicacion BETWEEN '$fechaInicial' AND '$fechaFinal' AND u.id_categorias = $categoria");
				} else {
					if ($fechaFinal == null and $categoria == null and $precioMax != null) {
						$query = $this->db->query("SELECT u.*,c.categorias FROM tbl_productos u JOIN tbl_categorias c ON c.id_categorias=u.id_categorias where u.id_usuarios = $id AND u.precio < $precioMax");
					}
				}
			}
		}

		if ($query != null) {
			return $query->result_array();
		} else {
			return array();
		}
	}
	public function get_user_information_id($id)//Retorna los datos del usuario indicado por parámetro
	{

		$query = $this->db->query("SELECT u.* FROM tbl_usuarios u where u.id_usuarios = $id");
		return $query->row_array();
	}
	public function calificarTienda($params)// Guarda una nueva calificacion de una tienda echa por un comprador.
	{
		$this->db->delete('tbl_calificacion_tienda', array('tienda_id_usuarios' =>  $params['tienda_id_usuarios'], 'comprador_id_usuarios' => $params['comprador_id_usuarios']));

		$this->db->insert('tbl_calificacion_tienda', $params);
		return $this->db->insert_id();
	}
	public function getCalificacionTiendaComprador($params)// Retorna la calificacion de una tienda echa por un usuario.
	{
		$query = $this->db->query("SELECT u.* FROM tbl_calificacion_tienda u where u.tienda_id_usuarios = " . $params['tienda_id_usuarios'] . "  AND u.comprador_id_usuarios = " . $params['comprador_id_usuarios']);
		if ($query->num_rows() == 1) {
			return $query->row_array();
		} else {
			return false;
		}
	}
	public function getCalificacionTienda($id)//Retorna todas las calificaciones de una tienda
	{
		$query = $this->db->query("SELECT u.* FROM tbl_calificacion_tienda u where u.tienda_id_usuarios = $id");
		return $query->result_array();
	}
	public function addNotificacionesProducto($params)//Crea una nueva notifacion.
	{
		$this->db->insert('tbl_notificaciones', $params);
		return $this->db->insert_id();
	}
	public function notificaionesTienda($id)//Retorna todas la notificaciones no vistas por una tienda
	{
		$query = $this->db->query("SELECT u.* FROM tbl_notificaciones u where u.id_usuarios = $id AND u.estado='N'");
		return $query->result_array();
	}
	public function ocultarNotificacion($id)//Cambia el estado de una notificacion ha ya vista.
	{
		$this->db->where('id_notificaciones', $id);
		$this->db->update('tbl_notificaciones', array('estado' => 'S'));
	}


	public function getSuscribircionTienda($params)//Obtiene si algun el usuario indicado por parametros esta suscrito a la tienda.
	{

		$query = $this->db->query("SELECT u.*FROM tbl_suscriptores u where u.tienda_id_usuarios = " . $params['tienda_id_usuarios'] . " AND u.comprador_id_usuarios = " . $params['comprador_id_usuarios']);
		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}
	public function desuscribirseTienda($params)//Elimina la suscripcion de un usuario a una tienda
	{
		$this->db->delete('tbl_suscriptores', array('tienda_id_usuarios' =>  $params['tienda_id_usuarios'], 'comprador_id_usuarios' => $params['comprador_id_usuarios']));
	}
	public function suscribirseTienda($params)//Agrega la suscripcion de un usuario a una tienda
	{
		$this->db->insert('tbl_suscriptores', $params);
		return $this->db->insert_id();
	}
	public function getSuscriptoresTienda($id)//Retorna todas las suscripciones de una tienda.
	{
		$query = $this->db->query("SELECT u.*, c.* FROM tbl_suscriptores u JOIN tbl_usuarios c ON c.id_usuarios=u.comprador_id_usuarios where u.tienda_id_usuarios = $id");
		return $query->result_array();
	}

	public function getDeseosProducto($id)//Retorna todos los usuarios que agregaron un producto en especifico a su lista de deseos.
	{
		$query = $this->db->query("SELECT u.* FROM tbl_carrito_deseos u where u.id_productos = $id AND u.tipo_producto='D'");
		return $query->result_array();
	}

	public function getCantidadDeseosProducto($id)// Retorna la cantidad de veces que esta agregado un producto en especifico a la lista de deseos.
	{
		$query = $this->db->query("SELECT u.* FROM tbl_carrito_deseos u where u.id_productos = $id AND u.tipo_producto='D'");
		return $query->num_rows();
	}

	public function getProductosVendidosTienda($id)//Retorna todos los productos vendidos por una tienda.
	{
		$query = $this->db->query("SELECT u.*,c.*,p.*,s.* FROM tbl_productos_compras u JOIN tbl_compras c ON c.id_compras=u.id_compras JOIN tbl_productos p ON p.id_productos=u.id_productos JOIN tbl_categorias s ON p.id_categorias=s.id_categorias  where p.id_usuarios = $id ");
		return $query->result_array();
	}
	public function getProductosVendidosTiendaRangoFecha($id, $FechaInicial, $FechaFinal)//Retorna todos los productos vendidos por una tienda, filtrados por un rango de fachas.
	{
		$query = $this->db->query("SELECT u.*,c.*,p.*,s.* FROM tbl_productos_compras u JOIN tbl_compras c ON c.id_compras=u.id_compras JOIN tbl_productos p ON p.id_productos=u.id_productos JOIN tbl_categorias s ON p.id_categorias=s.id_categorias  where p.id_usuarios = $id AND c.fecha between '" . $FechaInicial . "' AND '" . $FechaFinal . "'");
		return $query->result_array();
	}
	public function getSuscripcionesComprador($id)//Retorna todas las tiendas en las cuales el usuario especifico esta suscrito.
	{
		$query = $this->db->query("SELECT u.*, c.* FROM tbl_suscriptores u JOIN tbl_usuarios c ON c.id_usuarios=u.tienda_id_usuarios where u.comprador_id_usuarios = $id AND c.denuncias < 10 ");
		return $query->result_array();
	}
	public function getDeseosTiendaSuscripta($idTienda, $idComprador)//Retorna todos los productos en la lista de deseos de un usuario en especifico de una tienda. 
	{
		$query = $this->db->query("SELECT u.*, p.*,s.* FROM tbl_carrito_deseos u JOIN tbl_productos p ON p.id_productos = u.id_productos JOIN tbl_categorias s ON p.id_categorias=s.id_categorias WHERE p.id_usuarios=$idTienda AND u.id_usuarios = $idComprador AND u.tipo_producto='D'");
		return $query->result_array();
	}
	public function getProductosComprados($id)//Retorna todos los productos comprados por un usuario en especifico.
	{
		$query = $this->db->query("SELECT u.*,c.*,p.*,s.* FROM tbl_productos_compras u JOIN tbl_compras c ON c.id_compras=u.id_compras JOIN tbl_productos p ON p.id_productos=u.id_productos JOIN tbl_categorias s ON p.id_categorias=s.id_categorias  where c.id_usuarios = $id ");
		return $query->result_array();
	}
	public function getProductosCompradosRangoFecha($id, $FechaInicial, $FechaFinal)//Retorna todos los productos comprados por un usuario en especifico, filtrados por rango de fechas.
	{
		$query = $this->db->query("SELECT u.*,c.*,p.*,s.* FROM tbl_productos_compras u JOIN tbl_compras c ON c.id_compras=u.id_compras JOIN tbl_productos p ON p.id_productos=u.id_productos JOIN tbl_categorias s ON p.id_categorias=s.id_categorias  where c.id_usuarios = $id AND c.fecha between '" . $FechaInicial . "' AND '" . $FechaFinal . "'");
		return $query->result_array();
	}
	
	public function denunciarTienda($params)//Crea una nueva denuncia de una tienda en especifico.
	{
		$query = $this->db->query("SELECT u.*FROM tbl_denuncias u where u.tienda_id_usuarios = " . $params['tienda_id_usuarios'] . " AND u.comprador_id_usuarios = " . $params['comprador_id_usuarios']);
		if ($query->num_rows() == 0) {
			$this->db->insert('tbl_denuncias', $params);
			return $this->db->insert_id();
		}
	}
	public function getDenunciaTienda($params)//Obtiene si un usuario en especifico ha denunciado a una tienda en especifico.
	{

		$query = $this->db->query("SELECT u.*FROM tbl_denuncias u where u.tienda_id_usuarios = " . $params['tienda_id_usuarios'] . " AND u.comprador_id_usuarios = " . $params['comprador_id_usuarios']);
		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}
	public function get_Count_denuncias($id)//Cuenta las denuncias de una tienda.
	{
		$query = $this->db->query("SELECT COUNT(*) as cantidad FROM tbl_denuncias WHERE tbl_denuncias.tienda_id_usuarios = $id GROUP BY tbl_denuncias.tienda_id_usuarios");
		return $query->row_array();
	}
	public function editTienda($params, $id_usuarios)//Edita la informacion de una tienda, en este caso la cantidad de denuncias.
	{
		$this->db->where('id_usuarios', $id_usuarios);
		$this->db->update('tbl_usuarios', $params);
	}
}
