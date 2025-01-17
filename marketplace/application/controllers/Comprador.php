<?php

class Comprador extends CI_Controller
{
	public $mensaje = null;
	public $error = null;

	public function __construct()
	{

		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Comprador_model');
		$this->load->model('User_model');
	}

	//Muestra la vista compradorHome
	public function index($tienda_data = array())
	{
		$data['productos'] = $this->Comprador_model->get_all_productos();
		$data['galerias'] = $this->Comprador_model->get_all_galerias();
		$data['categorias'] = $this->Comprador_model->get_all_categorias();
		$data['pro'] = $this->Comprador_model->get_all_productos();
		$data['productosMasVendidos'] = $this->Comprador_model->get_productos_mas_vendidos();



		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['tipo'] == 'Comprador') {//se cargan estas listas si esta logueado como comprador
				$data['premios']= $this->Comprador_model->get_all_premios($this->session->userdata['logged_in']['users_id']);
				$data['notificaciones'] = $this->Comprador_model->notificaionesComprador($this->session->userdata['logged_in']['users_id']);
				$data['direcciones'] = $this->Comprador_model->get_direcciones($this->session->userdata['logged_in']['users_id']);
				$data['pagos'] = $this->Comprador_model->get_all_pago($this->session->userdata['logged_in']['users_id']);
				$data['compras'] = $this->Comprador_model->getCompras($this->session->userdata['logged_in']['users_id']);
				$data['val'] = true;
			} else {
				$data['val'] = false;
			}
			$data['seccion'] = $this->session->userdata['logged_in'];
			$data['carrito'] = $this->Comprador_model->get_all_carrito($this->session->userdata['logged_in']['users_id'], 'C');
			$data['Deseo'] = $this->Comprador_model->get_all_carrito($this->session->userdata['logged_in']['users_id'], 'D');
		} else {
			$data['seccion'] = FALSE;
			$data['val'] = true;
		}

		if ($tienda_data == null) {
			$data['tiendas'] = $this->Comprador_model->get_all_tiendas();
			$data['message_display'] = null;
		} else {//traer las tiendas con filtros,ya sea por categorias por producto en especifico o tienda
			if ($this->input->post('txt_tienda') != "") {
				$data['tiendas'] = $tienda_data;
				$data['message_display'] = null;
			} else if ($this->input->post('cmb_categoria') != "") {
				$data['message_display'] = null;
				$data['tiendas'] = $tienda_data;
				$data['productos'] = $this->Comprador_model->search_categoria($this->input->post('cmb_categoria'));
			} else if ($this->input->post('txt_producto') != "") {
				$data['message_display'] = null;
				$data['tiendas'] = $tienda_data;
				$data['productos'] = $this->Comprador_model->search_producto($this->input->post('txt_producto'));
			} else if ($this->input->post('btn_mas') != "" || $this->input->post('btn_carrito') != "" || $this->input->post('cmb_metodo') != "") {
				$data['tiendas'] = $this->Comprador_model->get_all_tiendas();
				$data['message_display'] = $tienda_data;
			}
		}

		$data['_view'] = 'comprador/compradorHome';//llama a la vista  
		$this->load->view('layouts/main', $data);
	}
	function compradorHome()
	{
		$this->index();
	}

	function ocultarNotificacion($id)//le cambia el estado a las notificaciones
	{
		$this->Comprador_model->ocultarNotificacion($id);
		$this->index();
	}

	function search()//realiza los filtros dependiendo cual utiliza el usuario
	{

		if ($this->input->post('txt_tienda') != "") {
			$result = $this->Comprador_model->search_tiendas($this->input->post('txt_tienda'));
			$this->index($result);
		} else if ($this->input->post('cmb_categoria') != "") {
			$result = $this->Comprador_model->search_categoriaT($this->input->post('cmb_categoria'));
			$this->index($result);
		} else if ($this->input->post('txt_producto') != "") {
			$result = $this->Comprador_model->search_productoT($this->input->post('txt_producto'));
			$this->index($result);
		} else {
			$this->index();
		}
	}
	// Funcion que redirige a la vista perfil producto
	function perfilProducto($id)
	{
		if (isset($this->session->userdata['logged_in'])) {//Ingresa solo si el usuario inició sesion
			$data['seccion'] = $this->session->userdata['logged_in'];
			$data['calificaciones'] = $this->Comprador_model->get_calificacion_producto_usuarioId($id, $this->session->userdata['logged_in']['users_id']);
		} else {
			$data['seccion'] = false;
		}
		$data['producto_id'] = $id;
		$data['producto'] = $this->Comprador_model->get_producto_id($id);
		$data['calificaciones_table'] = $this->Comprador_model->get_calificaciones_productos($id);
		$data['galeria'] = $this->Comprador_model->get_galerias($id);
		$data['calificacion'] = $this->calificacionProducto($id);
		$data['message_display'] = $this->mensaje;
		$data['error_message'] = $this->error;
		$data['_view'] = 'comprador/perfilProducto';
		$this->load->view('layouts/main', $data);
	}

	function addCarritoDeseo($id)//agrega los productos a la lista de deseos o a la lista del carrito
	{

		if ($this->input->post('btn_carrito')) {
			$tipo_producto = 'C';
			$result = $this->Comprador_model->search_carrito_deseo($this->session->userdata['logged_in']['users_id'], $id, $tipo_producto);
			$result2 = $this->Comprador_model->get_all_productos();
			if ($result != null) {
				foreach ($result2 as $r) {
					if ($r['id_productos'] == $result['id_productos']) {
						$suma2 = $result['cantidad'];
						if ($r['cantidad']  >= $suma2 + 1) {
							$suma = 0;
							$suma = $result['cantidad'];
							$suma = $suma + 1;
							$params = array(
								'cantidad' => $suma,
							);
							$this->Comprador_model->update_carrito($params, $id, $this->session->userdata['logged_in']['users_id']);
							$this->index();
							break;
						} else {
							$mesage = 'No hay suficiente producto en la tienda';
							$this->index($mesage);
						}
					}
				}
			} else {
				$igualCero = $this->Comprador_model->get_productoUnico($id);
				if ($igualCero['cantidad'] > 0) {
					$params = array(
						'id_usuarios' => $this->session->userdata['logged_in']['users_id'],
						'id_productos' => $id,
						'tipo_producto' => $tipo_producto,
						'cantidad' => 1,
					);
					$this->Comprador_model->add_carrito($params);
					$this->index();
				} else {
					$mesage = 'No hay suficiente producto en la tienda';
					$this->index($mesage);
				}
			}
		} else if ($this->input->post('btn_deseo')) {
			$tipo_producto = 'D';
			$result = $this->Comprador_model->search_carrito_deseo($this->session->userdata['logged_in']['users_id'], $id, $tipo_producto);

			if ($result == null) {
				$params = array(
					'id_usuarios' => $this->session->userdata['logged_in']['users_id'],
					'id_productos' => $id,
					'tipo_producto' => $tipo_producto,
					'cantidad' => 1,
				);
				$this->Comprador_model->add_carrito($params);
				$this->index();
			} else {
				$this->index();
			}
		}
	}

	function addCarritoDeseo2($id)
	{
		if ($this->input->post('btn_carrito')) {
			$tipo_producto = 'C';
			$result = $this->Comprador_model->search_carrito_deseo($this->session->userdata['logged_in']['users_id'], $id, $tipo_producto);
			$result2 = $this->Comprador_model->get_all_productos();
			if ($result != null) {
				foreach ($result2 as $r) {
					if ($r['id_productos'] == $result['id_productos']) {
						$suma2 = $result['cantidad'];
						if ($r['cantidad']  >= $suma2 + 1) {
							$suma = 0;
							$suma = $result['cantidad'];
							$suma = $suma + 1;
							$params = array(
								'cantidad' => $suma,
							);
							$this->Comprador_model->update_carrito($params, $id, $this->session->userdata['logged_in']['users_id']);
							$this->mensaje = 'Se ha actualizado el carrito de compras';

							break;
						} else {
							$this->mensaje = null;
							$this->error = 'No hay suficiente producto en la tienda';
						}
					}
				}
			} else {
				$igualCero = $this->Comprador_model->get_productoUnico($id);
				if ($igualCero['cantidad'] > 0) {
					$params = array(
						'id_usuarios' => $this->session->userdata['logged_in']['users_id'],
						'id_productos' => $id,
						'tipo_producto' => $tipo_producto,
						'cantidad' => 1,
					);
					$this->Comprador_model->add_carrito($params);
					$this->mensaje = 'Se ha agregado al carrito de compras';
				} else {
					$this->mensaje = null;
					$this->error = 'No hay suficiente producto en la tienda';
				}
			}
		} else if ($this->input->post('btn_deseo')) {
			$tipo_producto = 'D';
			$result = $this->Comprador_model->search_carrito_deseo($this->session->userdata['logged_in']['users_id'], $id, $tipo_producto);

			if ($result == null) {
				$params = array(
					'id_usuarios' => $this->session->userdata['logged_in']['users_id'],
					'id_productos' => $id,
					'tipo_producto' => $tipo_producto,
					'cantidad' => 1,
				);
				$this->Comprador_model->add_carrito($params);
				$this->mensaje = 'Se ha agregado a la lista de deseos';
			}
		}
		$this->perfilProducto($id);
	}

	function process($id)
	{
		if ($this->input->post('btn_eliminar_carrito')) {//se elimina del carrito
			$this->deleteCarrito($id, 'C');
		} else if ($this->input->post('btn_mas')) {//aumenta la cantidad del producto del carrito
			$this->masCarrito($id);
		} else if ($this->input->post('btn_menos')) {//disminuye la cantidad del producto del carrito
			$this->menosCarrito($id);
		} else if ($this->input->post('btn_eliminar_deseo')) {//se elimina de lista de deseos
			$this->deleteCarrito($id, 'D');
		}
	}



	function deleteCarrito($id, $tipo_producto)//elimina del carrito o de lista de deseo
	{
		$this->Comprador_model->delete_carrito($id, $tipo_producto);
		$this->index();
	}

	function menosCarrito($id)//disminuye la cantidad del producto del carrito
	{
		$result = $this->Comprador_model->search_carrito_deseo($this->session->userdata['logged_in']['users_id'], $id, 'C');
		$suma = 0;
		$suma = $result['cantidad'];
		$suma = $suma - 1;
		if ($suma >= 1) {
			$params = array(
				'cantidad' => $suma,
			);
			$this->Comprador_model->update_carrito($params, $id, $this->session->userdata['logged_in']['users_id']);
		}
		$this->index();
	}

	function masCarrito($id)//aumenta la cantidad del producto del carrito
	{
		$suma2 = 0;
		$result = $this->Comprador_model->search_carrito_deseo($this->session->userdata['logged_in']['users_id'], $id, 'C');
		$result2 = $this->Comprador_model->get_all_productos();
		foreach ($result2 as $r) {
			if ($r['id_productos'] == $result['id_productos']) {
				$suma2 = $result['cantidad'];
				if ($r['cantidad']  >= $suma2 + 1) {
					$suma = 0;
					$suma = $result['cantidad'];
					$suma = $suma + 1;
					$params = array(
						'cantidad' => $suma,
					);
					$this->Comprador_model->update_carrito($params, $id, $this->session->userdata['logged_in']['users_id']);
					$this->index();
					break;
				} else {
					$mesage = 'No hay suficiente producto en la tienda';
					$this->index($mesage);
				}
			}
		}
	}

	function facturaCompra($idCompra)
	{
		$compra =  $this->Comprador_model->getCompra($idCompra);
		$productos = $this->Comprador_model->getProductosCompra($compra['id_compras']);
		$compra = array("productos" => $productos) + $compra;
		$data['compra'] = $compra;
		$data['_view'] = 'reportes/factura';
		$this->load->view('layouts/main', $data);
	}
	function comprarProductos()//donde se realiza la compra de productos del carrito
	{
		$valor1 = 0;
		$valor2 = 0;
		$carrito = $this->Comprador_model->get_all_carrito($this->session->userdata['logged_in']['users_id'], 'C');
		$producto = $this->Comprador_model->get_all_productos();
		$dataa = array(
			'id_formas_pago' => $this->input->post('cmb_metodo'),
			'cvv' => $this->input->post('cvv')
		);
		$cvv = $this->Comprador_model->get_pagoUnico($dataa);//se comprueba que el cvv sea el de la tarjeta 



		$precioTotal=$this->input->post('total1');
		if ($cvv == TRUE) {
			$cvv =$this->Comprador_model->get_pagoUnicoTodo($this->input->post('cmb_metodo'));
			$saldo = $cvv['saldo'] - $precioTotal;
			if ($saldo > 0) {

				$boni =$this->input->post('cmb_boni');
				if($boni==0 || $boni=='')//comprueba si selecciono un descuneto o envio gratis
				{
					$params = array(
						'id_usuarios' => $this->session->userdata['logged_in']['users_id'],
						'id_formas_pago' => $this->input->post('cmb_metodo'),
						'fecha' => date('Y-m-d H:i:s'),
						'precio_total' => $precioTotal,
						'id_direcciones' => $this->input->post('cmb_direccion'),
						
						
					);
				}else{
					$params = array(
						'id_usuarios' => $this->session->userdata['logged_in']['users_id'],
						'id_formas_pago' => $this->input->post('cmb_metodo'),
						'fecha' => date('Y-m-d H:i:s'),
						'precio_total' => $precioTotal,
						'id_direcciones' => $this->input->post('cmb_direccion'),
						'id_premios' => $boni
					);

					$params7 = array(
						'estado' => 'Inactivo',
					);

					$this->Comprador_model->editPremio($params7 ,$boni);
				}
				
				$id_compra = $this->Comprador_model->add_compra($params);//agrega la compra



				$params1 = array(
					'saldo' => $saldo,
				);
				$this->Comprador_model->editMonto($params1, $this->input->post('cmb_metodo'));

				foreach ($carrito as $c) {
					foreach ($producto as $r) {
						if ($r['id_productos'] == $c['id_productos']) {
							$valor1 = $r['cantidad'] - $c['cantidad'];
							if ($valor1 >= 0) {//verifica que si haya cantidad de los productos en base de datos antes de realizar la compra
								$params = array(
									'cantidad' => $valor1,
								);
								$this->Comprador_model->editProducto($params, $r['id_productos']);//les reduce la cantidad(stock)
							}


							$this->Comprador_model->delete_carrito($r['id_productos'], 'C');//los elimina del carrito una vez comprados


							$params2 = array(
								'id_productos' => $r['id_productos'],
								'id_compras' => $id_compra,
								'cantidades' => $c['cantidad']
							);
							$this->Comprador_model->add_producto_compra($params2);

							$descripcion = $r['descripcion'];
							$params3 = array(
								'descripcion' => "El producto $descripcion fue comprado",
								'id_usuarios' => $r['id_usuarios'],
								'estado' => "N",
								'id_productos' => $r['id_productos']
							);
							$this->Comprador_model->addNotificacionesTienda($params3);//notifica a las tiendas de los productos comprados
						}
					}
				}
				$this->facturaCompra($id_compra);
			} else {
				$mesage = 'No tienes saldo suficiente para realizar la compra';
				$this->index($mesage);
			}
		} else {
			$mesage = 'CVV incorrecto porfavor vuelva a ingresar la información para realizar la compra';
			$this->index($mesage);
		}
	}

	// Funcion para calificar un producto y tambien para comentar un producto
	function calificarProducto($id)
	{

		$datas = $this->Comprador_model->get_calificacion_producto_usuarioId($id, $this->session->userdata['logged_in']['users_id']);

		if (isset($_POST['btn_rating2'])) {//Se ingresa a este apartado solo si el usuario ya realizó una calificacion previamente
			$calificacion = $this->input->post('star');
			$params = array(
				'calificacion' => $calificacion
			);
			$this->Comprador_model->actualizarCalificarProducto($params, $id, $this->session->userdata['logged_in']['users_id']);
		} else {
			// en este apartado se realiza la insercion de una calificacion y comentario de un producto
			if (isset($_POST['btn_rating1']) && empty($datas)) {
				$calificacion = $this->input->post('star');
				$params = array(
					'id_productos' => $id,
					'calificacion' => $calificacion,
					'comentarios' => $this->input->post('txt_comentario'),
					'respuetas' => '',
					'id_usuarios' => $this->session->userdata['logged_in']['users_id']
				);
				$this->Comprador_model->calificarProducto($params);
			} else {//se ingresa a este apartado solo si ya calificó un producto pero no realizó un comentario
				$calificacion = $this->input->post('star');
				$params = array(
					'id_productos' => $id,
					'calificacion' => $calificacion,
					'comentarios' => $this->input->post('txt_comentario')
				);
				$this->Comprador_model->actualizarCalificarProducto($params, $id, $this->session->userdata['logged_in']['users_id']);
			}
		}
		$this->mensaje = 'Has realizado una calificacion sobre el producto';
		$this->perfilProducto($id);
	}
	// Funcion para un usuario tienda que permita responder la retroalimentación de un comprador
	function respuestaComentarios($id_producto, $id_usuario)
	{
		$params = array(
			'respuetas' => $this->input->post('txt_respuesta')
		);
		$this->Comprador_model->actualizarCalificarProducto($params, $id_producto, $id_usuario);
		$this->perfilProducto($id_producto);
	}
	// Funcion que permite validar cierta información y redirige al usuario a la vista de la ruleta
	function ruleta()
	{
		if (isset($this->session->userdata['logged_in'])) {//solo se ingresa si el usuario inició sesion
			$data['seccion'] = $this->session->userdata['logged_in'];
			$data['metodos'] = $this->Comprador_model->get_all_pago($this->session->userdata['logged_in']['users_id']);;
			$data['user'] = $this->User_model->get_user($this->session->userdata['logged_in']['users_id']);
			$fecha = date("Y-m-d");
			if ($data['user']['fecha_giros'] < $fecha) {//en este apartado se valida si la fecha es diferente a la de hoy y se resetea la informacion de los giros
				$params2 = array(
					'fecha_giros' => $fecha,
					'cantidad_giros' => 0
				);
				$this->User_model->update_user($this->session->userdata['logged_in']['users_id'], $params2);
			}
		} else {
			$data['seccion'] = false;
		}
		if (sizeof($data['metodos']) == 0) {
			$this->error = 'Por favor agrega un metodo de pago a su usuario, ya que en caso de ser acreedor de uno de los premios le será requerido y luego vuelva a ingresar a este apartado';
		}
		$data['message_display'] = $this->mensaje;
		$data['error_message'] = $this->error;
		$data['_view'] = 'comprador/ruleta';
		$this->load->view('layouts/main', $data);
	}
	// Funcion que permite obtener la calificacion global(promedio) de un producto
	function calificacionProducto($id)
	{
		$calificaciones = $this->Comprador_model->get_calificaciones_productos($id);
		$calificacion = 0;
		foreach ($calificaciones as $value) {
			$calificacion += $value['calificacion'];
		}
		if (count($calificaciones) == 0) {
			return 0;
		} else {
			return number_format($calificacion / count($calificaciones), 0, ",", ".");
		}
	}
	// Funcion que permite almacenar los premios obtenidos de la ruleta
	function guardarPremio($id_usuario)
	{
		if ($this->input->post('premio') == 'Nada') {//Se ingresa si no se obteien premio y se le resta un giro 
			$fecha = date("Y-m-d");
			$user = $this->User_model->get_user($this->session->userdata['logged_in']['users_id']);
			if ($user['fecha_giros'] == '' || $user['fecha_giros'] == null) {
				$params2 = array(
					'fecha_giros' => $fecha,
					'cantidad_giros' => 1
				);
				$this->User_model->update_user($this->session->userdata['logged_in']['users_id'], $params2);
			} else {
				if ($user['fecha_giros'] < $fecha) {
					$params2 = array(
						'fecha_giros' => $fecha,
						'cantidad_giros' => 1
					);
					$this->User_model->update_user($this->session->userdata['logged_in']['users_id'], $params2);
				} else {
					if ($user['fecha_giros'] <= $fecha) {
						$cantidad = $user['cantidad_giros'] + 1;
						$params2 = array(
							'fecha_giros' => $fecha,
							'cantidad_giros' => $cantidad
						);
						$this->User_model->update_user($this->session->userdata['logged_in']['users_id'], $params2);
					}
				}
			}
		} else {
			if ($this->input->post('premio') == '%10') {
				$params = array(
					'descripcion' => $this->input->post('premio'),
					'estado' => 'Activo',
					'id_usuarios' => $this->session->userdata['logged_in']['users_id']
				);
				$this->Comprador_model->insertPremio($params);
			} else {
				if ($this->input->post('premio') == 'Envío') {

					$params = array(
						'descripcion' => $this->input->post('premio'),
						'estado' => 'Activo',
						'id_usuarios' => $this->session->userdata['logged_in']['users_id']
					);
					$this->Comprador_model->insertPremio($params);
				} else {
					if ($this->input->post('premio') == '$50') {
						$metodo = $this->Comprador_model->get_pagoId_pago($this->input->post('cmb_tarjetas'));
						$saldo = $metodo['saldo'] + 50;
						$params = array(
							'saldo' => $saldo,
						);
						$this->Comprador_model->editMonto($params, $this->input->post('cmb_tarjetas'));
					}
				}
			}
			// apartado para actualizar la fecha y la cantidad de giros del usuario
			$fecha = date("Y-m-d");
			$user = $this->User_model->get_user($this->session->userdata['logged_in']['users_id']);
			if ($user['fecha_giros'] == '' || $user['fecha_giros'] == null) {
				$params2 = array(
					'fecha_giros' => $fecha,
					'cantidad_giros' => 1
				);
				$this->User_model->update_user($this->session->userdata['logged_in']['users_id'], $params2);
			} else{
				if ($user['fecha_giros'] < $fecha) {
					$params2 = array(
						'fecha_giros' => $fecha,
						'cantidad_giros' => 1
					);
					$this->User_model->update_user($this->session->userdata['logged_in']['users_id'], $params2);
				} else {
					if ($user['fecha_giros'] <= $fecha) {
						$cantidad = $user['cantidad_giros'] + 1;
						$params2 = array(
							'fecha_giros' => $fecha,
							'cantidad_giros' => $cantidad
						);
						$this->User_model->update_user($this->session->userdata['logged_in']['users_id'], $params2);
					}
				}
			}
		}
		$this->ruleta();
	}
}
