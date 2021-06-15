<?php

class Tienda extends CI_Controller
{

	protected $error_message = null;
	protected $message_display = null;

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
		$productos = array();
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
		if ($this->error_message != null) {
			$data['error_message'] = $this->error_message;
			$this->error_message = null;
		}
		if ($this->message_display != null) {
			$data['message_display'] = $this->message_display;
			$this->message_display = null;
		}

		$data['productos'] =  $productos;
		$data['_view'] = $view;
		$this->load->view('layouts/main', $data);
	}

	function editProducto($id)
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
				'ubicacion_fisica' => $this->input->post('txt_ubicacion')
			);
			$this->Tienda_model->editProducto($params, $id);
			$this->notificarCambioProductos($id, $params['descripcion']);
			$this->message_display = 'Se ha editado el producto exitosamente.';
			$this->index();
		} else {
			$producto = $this->Tienda_model->get_productos_id($id);
			if ($producto != FALSE) {
				$categoria = $this->Tienda_model->get_categorias();
				$data['categorias'] = $categoria;
				$data['producto'] = $producto[0];
				$data['error_message'] = 'Ha ocurrido un error al editar el producto.';
				$data['_view'] = 'tienda/editProducto';
				$this->load->view('layouts/main', $data);
			} else {
				$this->index();
			}
		}
	}
	function mantPro($id)
	{
		if (isset($_POST['btn_perfil'])) {
			redirect('comprador/perfilProducto/' . $id, 'refresh');
		} else {
			if (isset($_POST['btn_elim'])) {
				try {
					$this->Tienda_model->get_elimnar_producto($id);
					$this->error_message =  "Se ha producido un error al eliminar el prodcuto.";
				} catch (Exception $e) {
					$this->message_display = "Producto eliminado correctamente.";
					
				}
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
	function notificarCambioProductos($id, $descripcion)
	{
		$deseos = $this->Tienda_model->getDeseosProducto($id);
		foreach ($deseos as $value) {
			$params = array(
				'descripcion' => "El producto $descripcion cambio",
				'id_usuarios' => $value['id_usuarios'],
				'estado' => "N"
			);
			$this->Tienda_model->addNotificacionesProducto($params);
		}
	}
	function addProducto($opcion)
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

			$this->message_display = 'Se ha guardado el producto exitosamente.';
			$this->index();
		} else {
			if ($opcion == 0) {
				$data['error_message'] = "Error al guardar el producto";
			}
			$categoria = $this->Tienda_model->get_categorias();
			$data['categorias'] = $categoria;
			$data['_view'] = 'tienda/addProducto';
			$this->load->view('layouts/main', $data);
		}
	}
	function mantGaleriaProductos($id)
	{
		if ($this->error_message != null) {
			$data['error_message'] = $this->error_message;
			$this->error_message = null;
		}
		if ($this->message_display != null) {
			$data['message_display'] = $this->message_display;
			$this->message_display = null;
		}

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
			$this->message_display = "Foto agregada correctamente.";
		} else {
			$this->error_message = "Ocurrio un problema al cargar la foto.";
		}

		$this->mantGaleriaProductos($id);
	}
	function deleteFoto($idproducto, $idfoto)
	{
		$this->Tienda_model->deleteFoto($idfoto);
		$this->message_display = "Foto eliminada correctamente.";
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
	function buscarProductosPerfil($id)
	{
		$cate = $this->input->post('cmb_categoria');
		$desc = $this->input->post('txt_buscar');
		if ($cate == 0) {
			$cate = null;
		}
		if ($desc == '') {
			$desc = null;
		}
		$this->perfiltienda($id, $cate, $desc);
	}
	function perfiltienda($id, $catego = null, $descri = null)
	{
		$data['suscrito'] = true;
		$data['denuncia'] = true;
		$data['calificacionComprador'] = array('calificacion' => 0);
		if (isset($this->session->userdata['logged_in'])) {
			$params = array(
				'comprador_id_usuarios' => $this->session->userdata['logged_in']['users_id'],
				'tienda_id_usuarios' => $id
			);
			$data['denuncia'] = $this->Tienda_model->getDenunciaTienda($params);
			$data['suscrito'] = $this->Tienda_model->getSuscribircionTienda($params);
			if ($this->Tienda_model->getCalificacionTiendaComprador($params) != false) {
				$data['calificacionComprador'] = $this->Tienda_model->getCalificacionTiendaComprador($params);
			}
		}

		$data['calificacion'] = $this->calificaciontienda($id);
		$data['tienda'] =  $this->Tienda_model->get_user_information_id($id);
		$productos = array();
		if ($catego == null and $descri == null) {
			$productos = $this->Tienda_model->get_productos_tienda($id);
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
		if ($this->error_message != null) {
			$data['error_message'] = $this->error_message;
			$this->error_message = null;
		}
		if ($this->message_display != null) {
			$data['message_display'] = $this->message_display;
			$this->message_display = null;
		}

		$categoria = $this->Tienda_model->get_categorias();
		$data['categorias'] = $categoria;
		$data['productos'] = $productos;
		$data['_view'] = "tienda/perfiltienda";
		$this->load->view('layouts/main', $data);
	}
	function denunciarTienda($id)
	{
		$params = array(
			'comprador_id_usuarios' => $this->session->userdata['logged_in']['users_id'],
			'tienda_id_usuarios' => $id
		);
		$this->Tienda_model->denunciarTienda($params);
		$this->message_display = "Tienda denunciada correctamente.";
		$this->perfiltienda($id);
	}
	function suscribirseTienda($id)
	{
		$params = array(
			'comprador_id_usuarios' => $this->session->userdata['logged_in']['users_id'],
			'tienda_id_usuarios' => $id
		);
		if ($this->input->post("btn_suscripcion") == "Suscribirse") {
			$this->Tienda_model->suscribirseTienda($params);
			$this->message_display = "Suscrito correctamente.";
		} else {
			if ($this->input->post("btn_suscripcion") == "Desuscribirse") {
				$this->Tienda_model->desuscribirseTienda($params);
				$this->message_display = "Desuscribido correctamente.";
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
		$this->message_display = "Tienda calificada correctamente.";
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
			$this->message_display = "Categoria guardada correctamente.";
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
		if ($this->error_message != null) {
			$data['error_message'] = $this->error_message;
			$this->error_message = null;
		}
		if ($this->message_display != null) {
			$data['message_display'] = $this->message_display;
			$this->message_display = null;
		}
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
	function ventas($id, $FechaIni = null, $FechaFin = null)
	{
		if ($FechaIni != null and $FechaFin != null) {

			$productos = $this->Tienda_model->getProductosVendidosTiendaRangoFecha($id, $FechaIni, $FechaFin);
		} else {
			$productos = $this->Tienda_model->getProductosVendidosTienda($id);
		}
		$data['FechaIni'] = $FechaIni;
		$data['FechaFin'] = $FechaFin;
		$data['productos'] = $productos;
		$data['_view'] = "reportes/ventas";
		$this->load->view('layouts/main', $data);
	}

	function buscarProductosReportes()
	{
		$FechaInicial = $this->input->post('FechaInicial');
		$FechaFinal = $this->input->post('FechaFinal');
		if ($FechaInicial == "" and $FechaFinal == "") {
			$this->ventas($this->session->userdata['logged_in']['users_id']);
		} else {
			$this->ventas($this->session->userdata['logged_in']['users_id'], $FechaInicial, $FechaFinal);
		}
	}




	function compras($id, $FechaIni = null, $FechaFin = null)
	{
		if ($FechaIni != null and $FechaFin != null) {

			$productos = $this->Tienda_model->getProductosCompradosRangoFecha($id, $FechaIni, $FechaFin);
		} else {
			$productos = $this->Tienda_model->getProductosComprados($id);
		}
		$data['FechaIni'] = $FechaIni;
		$data['FechaFin'] = $FechaFin;
		$data['productos'] = $productos;
		$data['_view'] = "reportes/compras";
		$this->load->view('layouts/main', $data);
	}
	function buscarProductosReportesCompras()
	{
		$FechaInicial = $this->input->post('FechaInicial');
		$FechaFinal = $this->input->post('FechaFinal');
		if ($FechaInicial == "" and $FechaFinal == "") {
			$this->compras($this->session->userdata['logged_in']['users_id']);
		} else {
			$this->compras($this->session->userdata['logged_in']['users_id'], $FechaInicial, $FechaFinal);
		}
	}

	function suscripciones($id)
	{
		$tiendas = $this->Tienda_model->getSuscripcionesComprador($id);
		$cont = 0;
		foreach ($tiendas as $val) {
			$productos = $this->Tienda_model->getDeseosTiendaSuscripta($val['id_usuarios'], $id);
			$tiendas[$cont] = array("productos" => $productos) + $tiendas[$cont];
			$cont++;
		}
		$data['tiendas'] = $tiendas;
		$data['_view'] = "reportes/suscripciones";
		$this->load->view('layouts/main', $data);
	}
	function getTiendasProductos($categoria = null, $FechaInicial = null, $FechaFinal = null, $precio = null)
	{
		$tiendas = array();
		if ($precio != null) {
			$tiendas = $this->Tienda_model->get_all_tiendas();
			$cont = 0;
			foreach ($tiendas as $val) {
				$productos = $this->Tienda_model->buscarProductosOfertas($val['id_usuarios'], $categoria, $FechaInicial, $FechaFinal, $precio);
				$tiendas[$cont] = array("productos" => $productos) + $tiendas[$cont];
				$cont++;
			}
		}
		$data['fechaIni'] = $FechaInicial;
		$data['fechaFin'] = $FechaFinal;
		$data['categoria'] = $categoria;
		$data['precio'] = $precio;
		$categorias = $this->Tienda_model->get_categorias();
		$data['categorias'] = $categorias;
		$data['tiendas'] = $tiendas;
		$data['_view'] = "reportes/ofertas";
		$this->load->view('layouts/main', $data);
	}
	function buscarProductosReportesOfertas()
	{

		$FechaInicial = $this->input->post('FechaInicial');
		$FechaFinal = $this->input->post('FechaFinal');
		$categoria = $this->input->post('cmb_categoria');
		$precio = $this->input->post('precio');

		if ($categoria == "Seleccionar categoría") {
			$categoria = null;
		}
		$this->getTiendasProductos($categoria, $FechaInicial, $FechaFinal, $precio);
	}
}
