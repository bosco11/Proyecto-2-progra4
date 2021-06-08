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
	function load_data_view($view,  $id = null, $catego = null, $descri = null)
	{
		// precarga todos los datos con los que la vista debe iniciar
		$this->load->model('Tienda_model');
		$categoria = $this->Tienda_model->get_categorias();
		$data['categorias'] = $categoria;
		$data['notificaciones'] = $this->Tienda_model->notificaionesTienda($this->session->userdata['logged_in']['users_id']);
		if ($catego == null and $descri == null) {
			$productos = $this->Tienda_model->get_productos_tienda($this->session->userdata['logged_in']['users_id']);
			$cont = 0;
			$cantidad = 0;
			foreach ($productos as $value) {
				$cantidad = $this->Tienda_model->getCantidadDeseosProducto($value['id_productos']);
				$productos[$cont] = array("cantidadDeseos" => $cantidad) + $productos[$cont];
				$cont++;
			}
		} else {
			$productos = $this->Tienda_model->buscarProductos($id, $catego, $descri);
			$cont = 0;
			$cantidad = 0;
			foreach ($productos as $value) {
				$cantidad = $this->Tienda_model->getCantidadDeseosProducto($value['id_productos']);
				$productos[$cont] = array("cantidadDeseos" => $cantidad) + $productos[$cont];
				$cont++;
			}
		}
		$data['productos'] =  $productos;
		$data['_view'] = $view;
		$this->load->view('layouts/main', $data);
	}
	function mantPro($id)
	{


		if (isset($_POST['btn_elim'])) {
			$this->Tienda_model->get_elimnar_producto($id);
			redirect('tienda/tiendaHome', 'refresh');
		} else {
			$this->load->library('form_validation');

			$this->form_validation->set_rules('txt_descripcion', 'Decripcion', 'required|max_length[200]');
			$this->form_validation->set_rules('txt_cantidad', 'Cantidad', 'required|max_length[20]');
			$this->form_validation->set_rules('txt_costoEnvio', 'ContoEnvio', 'required|max_length[200]');
			$this->form_validation->set_rules('txt_precio', 'Precio', 'required|max_length[200]');
			$this->form_validation->set_rules('cmb_categoria', 'Categoria', 'required|max_length[200]');
			$this->form_validation->set_rules('txt_entrega', 'Entrega', 'required|max_length[45]');
			$this->form_validation->set_rules('txt_ubicacion', 'Ubicacion', 'required|max_length[200]');

			if ($this->form_validation->run()) {
				$params = array(
					'descripcion' => $this->input->post('txt_descripcion'),
					'cantidad' => $this->input->post('txt_cantidad'),
					'id_categorias ' => $this->input->post('cmb_categoria'),
					'id_usuarios ' => $this->session->userdata['logged_in']['users_id'],
					'costo_envio' => $this->input->post('txt_costoEnvio'),
					'tiempo_promedio' => $this->input->post('txt_entrega'),
					'precio' => $this->input->post('txt_precio'),
					'ubicacion_fisica' => $this->input->post('txt_ubicacion')
				);
				$this->Tienda_model->editProducto($params, $id);

				$data['message_display'] = 'Se ha guardado el producto exitosamente.';
				$this->index();
			} else {
				$producto = $this->Tienda_model->get_productos_id($id);
				if ($producto != FALSE) {
					$categoria = $this->Tienda_model->get_categorias();
					$data['categorias'] = $categoria;
					$data['producto'] = $producto[0];
					$data['_view'] = 'tienda/editProducto';
					$this->load->view('layouts/main', $data);
				} else {
					$this->index();
				}
			}
		}
	}
	function addProducto()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txt_descripcion', 'Decripcion', 'required|max_length[200]');
		$this->form_validation->set_rules('txt_cantidad', 'Cantidad', 'required|max_length[20]');
		$this->form_validation->set_rules('txt_costoEnvio', 'ContoEnvio', 'required|max_length[200]');
		$this->form_validation->set_rules('txt_precio', 'Precio', 'required|max_length[200]');
		$this->form_validation->set_rules('cmb_categoria', 'Categoria', 'required|max_length[200]');
		$this->form_validation->set_rules('txt_entrega', 'Entrega', 'required|max_length[45]');
		$this->form_validation->set_rules('txt_ubicacion', 'Ubicacion', 'required|max_length[200]');

		if ($this->form_validation->run()) {
			$params = array(
				'descripcion' => $this->input->post('txt_descripcion'),
				'cantidad' => $this->input->post('txt_cantidad'),
				'id_categorias ' => $this->input->post('cmb_categoria'),
				'id_usuarios ' => $this->session->userdata['logged_in']['users_id'],
				'costo_envio' => $this->input->post('txt_costoEnvio'),
				'tiempo_promedio' => $this->input->post('txt_entrega'),
				'precio' => $this->input->post('txt_precio'),
				'ubicacion_fisica' => $this->input->post('txt_ubicacion'),
				'fecha_publicacion' => date("Y/m/d")
			);
			$this->Tienda_model->addProducto($params);

			$data['message_display'] = 'Se ha guardado el producto exitosamente.';
			$this->index();
		} else {
			$categoria = $this->Tienda_model->get_categorias();
			$data['categorias'] = $categoria;
			$data['_view'] = 'tienda/addProducto';
			$this->load->view('layouts/main', $data);
		}
	}
	function mantGaleriaProductos($id)
	{

		$producto = $this->Tienda_model->get_productos_id($id);
		$fotos = $this->Tienda_model->getFotosProducto($id);
		$data['producto'] = $producto[0];
		$data['fotos'] = $fotos;
		$data['_view'] = 'tienda/addGaleriaProductos';
		$this->load->view('layouts/main', $data);
	}
	function addFotoProducto($id)
	{
		$config['upload_path']          = './resources/files/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2000; //2MB
		$config['overwrite']            = true;

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('txt_file')) {
			$params = array(
				'id_productos' => $id,
				'imagen_producto' =>  $this->upload->data('file_name')
			);
			$this->Tienda_model->addFotoProducto($params);
		}
		$this->mantGaleriaProductos($id);
	}
	function deleteFoto($idproducto, $idfoto)
	{
		$this->Tienda_model->deleteFoto($idfoto);
		$this->mantGaleriaProductos($idproducto);
	}
	function buscarProductos($id)
	{
		$cate = $this->input->post('cmb_categoria');
		$desc = $this->input->post('txt_buscar');
		if ($cate == 0) {
			$cate = null;
		}
		if ($desc == '') {
			$desc = null;
		}
		$this->load_data_view('tienda/tiendaHome', $id, $cate, $desc);
	}
	function perfiltienda($id)
	{
		$data['suscrito'] = true;
		$data['calificacionComprador'] = 0;
		if (isset($this->session->userdata['logged_in'])) {
			$params = array(
				'comprador_id_usuarios' => $this->session->userdata['logged_in']['users_id'],
				'tienda_id_usuarios' => $id
			);
			$data['suscrito'] = $this->Tienda_model->getSuscribircionTienda($params);
			if ($this->Tienda_model->getCalificacionTiendaComprador($params) != false) {
				$data['calificacionComprador'] = $this->Tienda_model->getCalificacionTiendaComprador($params);
			}
		}

		$data['calificacion'] = $this->calificaciontienda($id);
		$data['tienda'] =  $this->Tienda_model->get_user_information_id($id);
		$data['productos'] = $this->Tienda_model->get_productos_tienda($id);
		$data['_view'] = "tienda/perfiltienda";
		$this->load->view('layouts/main', $data);
	}
	function suscribirseTienda($id)
	{
		$params = array(
			'comprador_id_usuarios' => $this->session->userdata['logged_in']['users_id'],
			'tienda_id_usuarios' => $id
		);
		if ($this->input->post("btn_suscripcion") == "Suscribirse") {
			$this->Tienda_model->suscribirseTienda($params);
		} else {
			if ($this->input->post("btn_suscripcion") == "Desuscribirse") {
				$this->Tienda_model->desuscribirseTienda($params);
			}
		}
		$this->perfiltienda($id);
	}
	function calificarPro($id)
	{
		$calificacion = $this->input->post('star');

		$params = array(
			'calificacion' => $calificacion,
			'tienda_id_usuarios' => $id,
			'comprador_id_usuarios' => $this->session->userdata['logged_in']['users_id']
		);
		$this->Tienda_model->calificarTienda($params);
		$this->perfiltienda($id);
	}
	function ocultarNotificacion($id)
	{
		$this->Tienda_model->ocultarNotificacion($id);
		$this->index();
	}
	function addCategoria($id = null)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt_categoria', 'Nombre de la categoria', 'required|max_length[200]');
		if ($this->form_validation->run()) {
			$params = array(
				'categorias' => $this->input->post('txt_categoria')
			);
			if ($id != null) {
				$this->Tienda_model->editCategoria($id, $params);
			} else {
				$this->Tienda_model->addCategoria($params);
			}
			$this->mantCategoria();
		} else {
			if ($id != null) {
				$data['categoria'] = $this->Tienda_model->get_categorias_id($id);
			} else {
				$data['categoria'] = null;
			}
			$data['_view'] = "tienda/addCategoria";
			$this->load->view('layouts/main', $data);
		}
	}
	function mantCategoria()
	{
		$categoria = $this->Tienda_model->get_categorias();
		$data['categorias'] = $categoria;
		$data['_view'] = "tienda/mantCategorias";
		$this->load->view('layouts/main', $data);
	}
	function calificaciontienda($id)
	{
		$calificaciones = $this->Tienda_model->getCalificacionTienda($id);
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
	function viewSuscriptores($id)
	{
		$suscriptores = $this->Tienda_model->getSuscriptoresTienda($id);
		$data['suscriptores'] = $suscriptores;
		$data['_view'] = "tienda/suscriptoresTienda";
		$this->load->view('layouts/main', $data);
	}
}
