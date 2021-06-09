<?php

class Comprador extends CI_Controller
{
	
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

		if (isset($this->session->userdata['logged_in'])) {
			$data['seccion'] = $this->session->userdata['logged_in'];
			$data['carrito'] = $this->Comprador_model->get_all_carrito($this->session->userdata['logged_in']['users_id']);
		} else {
			$data['seccion'] = false;
		}

		if ($tienda_data == null) {
			$data['tiendas'] = $this->Comprador_model->get_all_tiendas();
		} else {
			if ($this->input->post('txt_tienda') != "") {
				$data['tiendas'] = $tienda_data;
			} else if ($this->input->post('cmb_categoria') != "") {
				$data['tiendas'] = $tienda_data;
				$data['productos'] = $this->Comprador_model->search_categoria($this->input->post('cmb_categoria'));
			} else if ($this->input->post('txt_producto') != "") {
				$data['tiendas'] = $tienda_data;
				$data['productos'] = $this->Comprador_model->search_producto($this->input->post('txt_producto'));
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

	// function load_data_view($view)
	// {
	// 	// precarga todos los datos con los que la vista debe iniciar
	// 	// $this->load->model('Twitter_model');
	//     // $data['tweets'] = $this->Twitter_model->get_all_tweets();
	//     $data['_view'] = $view;
	// 	$this->load->view('layouts/main',$data);
	// }
	function perfilProducto($id)
	{
		if (isset($this->session->userdata['logged_in'])) {
			$data['seccion'] = $this->session->userdata['logged_in'];
		} else {
			$data['seccion'] = false;
		}
		$data['producto'] = $this->Comprador_model->get_producto_id($id);
		$data['galeria'] = $this->Comprador_model->get_galerias($id);
		$data['message_display'] = null;
		$data['_view'] = 'comprador/perfilProducto';
		$this->load->view('layouts/main', $data);
	}

	function addCarritoDeseo($id)
	{

		if ($this->input->post('btn_carrito')) {
			$tipo_producto = 'C';
		} else {
			$tipo_producto = 'D'; //lista de deseo FALTA----------------------------------------------------------
		}

		$result = $this->Comprador_model->search_carrito_deseo($this->session->userdata['logged_in']['users_id'], $id, $tipo_producto);

		if ($result != null) {
			$suma = 0;
			$suma = $result['cantidad'];
			$suma = $suma + 1;
			$params = array(
				'cantidad' => $suma,
			);
			$this->Comprador_model->update_carrito($params, $id, $this->session->userdata['logged_in']['users_id']);
		} else {
			$params = array(
				'id_usuarios' => $this->session->userdata['logged_in']['users_id'],
				'id_productos' => $id,
				'tipo_producto' => $tipo_producto,
				'cantidad' => 1,
			);
			$this->Comprador_model->add_carrito($params);
		}
		$this->index();
	}

	function process($id)
	{
		if ($this->input->post('btn_eliminar')) {
			$this->deleteCarrito($id);
		} else if ($this->input->post('btn_mas')) {
			$this->masCarrito($id);
		} else if ($this->input->post('btn_menos')) {
			$this->menosCarrito($id);
		}
	}

	function deleteCarrito($id)
	{
		$this->Comprador_model->delete_carrito($id);
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
		$result = $this->Comprador_model->search_carrito_deseo($this->session->userdata['logged_in']['users_id'], $id, 'C');
		$suma = 0;
		$suma = $result['cantidad'];
		$suma = $suma + 1;
		$params = array(
			'cantidad' => $suma,
		);
		$this->Comprador_model->update_carrito($params, $id, $this->session->userdata['logged_in']['users_id']);
		$this->index();
	}


	function calificarProducto($id)
	{
		$calificacion = $this->input->post('star');
		print_r($calificacion);
		// $params = array(
		// 	'id_productos' => $id,
		// 	'calificacion' => $calificacion,
		// 	'comentarios' => $this->input->post('txt_comentario'),
		// 	'id_usuarios' => $this->session->userdata['logged_in']['users_id']
		// );
		// $this->Comprador_model->calificarProducto($params);
		// $this->perfilProducto($id);
	}
}
