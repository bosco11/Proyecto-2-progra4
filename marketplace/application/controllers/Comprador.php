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
	}

	//Muestra la vista del Login
	public function index($tienda_data = array())
	{
		$data['productos'] = $this->Comprador_model->get_all_productos();
		$data['galerias'] = $this->Comprador_model->get_all_galerias();
		$data['categorias'] = $this->Comprador_model->get_all_categorias();
		$data['pro'] = $this->Comprador_model->get_all_productos();
		$data['pagos'] = $this->Comprador_model->get_all_pago($this->session->userdata['logged_in']['users_id']);
		$data['direcciones'] = $this->Comprador_model->get_direcciones($this->session->userdata['logged_in']['users_id']);

		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['tipo'] == 'Comprador') {
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
		} else {
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
			} else if ($this->input->post('btn_mas') != "" || $this->input->post('btn_carrito') != "") {
				$data['tiendas'] = $this->Comprador_model->get_all_tiendas();
				$data['message_display'] = $tienda_data;
			}
		}

		$data['_view'] = 'comprador/compradorHome';
		$this->load->view('layouts/main', $data);
		// $this->load_data_view('comprador/compradorHome');
	}
	function compradorHome()
	{
		$this->index();
	}

	function search()
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

	function perfilProducto($id)
	{
		if (isset($this->session->userdata['logged_in'])) {
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

	function addCarritoDeseo($id)
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
				$params = array(
					'id_usuarios' => $this->session->userdata['logged_in']['users_id'],
					'id_productos' => $id,
					'tipo_producto' => $tipo_producto,
					'cantidad' => 1,
				);
				$this->Comprador_model->add_carrito($params);
				$this->index();
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
				$params = array(
					'id_usuarios' => $this->session->userdata['logged_in']['users_id'],
					'id_productos' => $id,
					'tipo_producto' => $tipo_producto,
					'cantidad' => 1,
				);
				$this->Comprador_model->add_carrito($params);
				$this->mensaje = 'Se ha agregado al carrito de compras';
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
		if ($this->input->post('btn_eliminar_carrito')) {
			$this->deleteCarrito($id, 'C');
		} else if ($this->input->post('btn_mas')) {
			$this->masCarrito($id);
		} else if ($this->input->post('btn_menos')) {
			$this->menosCarrito($id);
		} else if ($this->input->post('btn_eliminar_deseo')) {
			$this->deleteCarrito($id, 'D');
		}
	}



	function deleteCarrito($id, $tipo_producto)
	{
		$this->Comprador_model->delete_carrito($id, $tipo_producto);
		$this->index();
	}

	function menosCarrito($id)
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

	function masCarrito($id)
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


	function calificarProducto($id)
	{

		$datas = $this->Comprador_model->get_calificacion_producto_usuarioId($id, $this->session->userdata['logged_in']['users_id']);

		if (isset($_POST['btn_rating2'])) {
			$calificacion = $this->input->post('star');
			$params = array(
				'calificacion' => $calificacion
			);
			$this->Comprador_model->actualizarCalificarProducto($params, $id, $this->session->userdata['logged_in']['users_id']);
		} else {

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
			} else {
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
	function respuestaComentarios($id_producto, $id_usuario)
	{
		$params = array(
			'respuetas' => $this->input->post('txt_respuesta')
		);
		$this->Comprador_model->actualizarCalificarProducto($params, $id_producto, $id_usuario);
		$this->perfilProducto($id_producto);
	}
	function ruleta()
	{
		if (isset($this->session->userdata['logged_in'])) {
			$data['seccion'] = $this->session->userdata['logged_in'];
		} else {
			$data['seccion'] = false;
		}
		$data['message_display'] = null;
		$data['_view'] = 'comprador/ruleta';
		$this->load->view('layouts/main', $data);
	}
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
}
