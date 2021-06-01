<?php

class Tienda extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Tienda_model');
	}

	//Muestra la vista del Login
	public function index()
	{
		$this->load_data_view('tienda/tiendaHome');
	}
	function tiendaHome()
	{
		$this->index();
	}

	function load_data_view($view)
	{
		// precarga todos los datos con los que la vista debe iniciar
		$this->load->model('Tienda_model');
		$data['productos'] = $this->Tienda_model->get_productos_tienda($this->session->userdata['logged_in']['users_id']);
		$data['_view'] = $view;
		$this->load->view('layouts/main', $data);
	}
	function mantPro($id)
	{
		if (isset($_POST['btn_editar'])) {
			$producto = $this->Tienda_model->get_productos_id($id);
			if ($producto != FALSE) {
				$data['producto'] = $producto[0];
				$data['_view'] = 'tienda/mantProducto';
				$this->load->view('layouts/main', $data);
			}
		}else{
			if (isset($_POST['btn_elim'])){
				$this->Tienda_model->get_elimnar_producto($id);
				redirect('tienda/tiendaHome', 'refresh');
			}
		}
	}
}
