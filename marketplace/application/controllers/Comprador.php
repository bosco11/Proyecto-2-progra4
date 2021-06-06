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

		if (isset($this->session->userdata['logged_in'])) {
			$data['seccion'] = $this->session->userdata['logged_in'];
		} else {
			$data['seccion'] = false;
		}

		if ($tienda_data == null) {
			$data['tiendas'] = $this->Comprador_model->get_all_tiendas();
		} else {
			if($this->input->post('txt_tienda')!= "" || $this->input->post('cmb_categoria')!= "")
			{
				$data['tiendas'] = $tienda_data;
			}
			else if($this->input->post('txt_producto')!= ""){
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
			$result = $this->Comprador_model->search_categoria($this->input->post('cmb_categoria'));
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

}
