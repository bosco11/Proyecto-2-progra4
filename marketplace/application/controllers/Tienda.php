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

	public function index()//Metodo para principal creado para llamar a la funcion que carga la vista
	{
		$this->load_data_view('tienda/tiendaHome');
	}
	function tiendaHome()//Metodo para principal creado para llamar a la funcion que carga la vista
	{
		$this->index();
	}
	function load_data_view($view,  $id = null, $catego = null, $descri = null)// precarga todos los datos con los que la vista debe iniciar ademas de ña vista
	{
		
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

	function editProducto($id)// Metodo para editar los productos, recibiendo por prarametros el id.
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
	function mantPro($id)//Metodo encargado de hcaer 3 acciones dependiondo del boton prescio, la cuales son ver perfil del producto, eliminar el producto o bien redirrecionar a la pantalla de editar producto
	{
		if (isset($_POST['btn_perfil'])) {
			redirect('comprador/perfilProducto/' . $id, 'refresh');
		} else {
			if (isset($_POST['btn_elim'])) {

				if ($this->Tienda_model->get_elimnar_producto($id)) {
					$this->message_display = "Producto eliminado correctamente.";
				} else {
					$this->error_message =  "Se ha producido un error al eliminar el producto.";
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
	function notificarCambioProductos($id, $descripcion)//Metodo encargado de enviar notificaciones a los usuarios cuando tiene un producto que sea editado en lista de deseos
	{
		$deseos = $this->Tienda_model->getDeseosProducto($id);
		foreach ($deseos as $value) {
			$params = array(
				'descripcion' => "Se realizaron cambios en $descripcion",
				'id_usuarios' => $value['id_usuarios'],
				'estado' => "N",
				'id_productos' => $id
			);
			$this->Tienda_model->addNotificacionesProducto($params);
		}
	}
	function addProducto($opcion)// Metodo encargado de crear un producto
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
	function mantGaleriaProductos($id)// Metodo encragado de redireccionar la aplicacion a la vista de galeria de productos
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
	function addFotoProducto($id)//Metodo que inserta una nueva foto a la galeria de algun producto.
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
	function deleteFoto($idproducto, $idfoto)//Metodo que elimina una foto de la galeria de algun producto.
	{
		$this->Tienda_model->deleteFoto($idfoto);
		$this->message_display = "Foto eliminada correctamente.";
		$this->mantGaleriaProductos($idproducto);
	}
	function buscarProductos($id,$perfil = null)//Meotodo encargado de recibir los filtros echos por el usuario y asi volviendo a llamar la vista principal o de perfil tienda pero con los productos filtrados.
	{
		$cate = $this->input->post('cmb_categoria');
		$desc = $this->input->post('txt_buscar');
		if ($cate == 0) {
			$cate = null;
		}
		if ($desc == '') {
			$desc = null;
		}
		if($perfil == null){
		$this->load_data_view('tienda/tiendaHome', $id, $cate, $desc);
		}else{
			$this->perfiltienda($id, $cate, $desc);
		}
	}
	function perfiltienda($id, $catego = null, $descri = null)//Metodo encergado de precargar todos los datos necesarios para cargar la vista Perfil de la tienda, para luego cargar dicha vista
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
	function denunciarTienda($id)//Metodo encargado de agregarle una denuncia a una tienda.
	{
		$params = array(
			'comprador_id_usuarios' => $this->session->userdata['logged_in']['users_id'],
			'tienda_id_usuarios' => $id
		);
		$this->Tienda_model->denunciarTienda($params);
		$count = $this->Tienda_model->get_Count_denuncias($id);
		$params = array(
			'denuncias' => $count['cantidad']
		);
		$this->Tienda_model->editTienda($params,$id);

		$this->message_display = "Tienda denunciada correctamente.";
		$this->perfiltienda($id);
	}
	function suscribirseTienda($id)//Metodo encargado de agregar una suscripcion a una tienda.
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
	function calificarPro($id)//Metodo encargado de calificar una tienda.
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
	function ocultarNotificacion($id, $idProducto)//Metodo encargado de ocultarle una notificacion a algun usuario y redirecionarlo a dicho producto participante en la notificacion.
	{
		$this->Tienda_model->ocultarNotificacion($id);
		redirect('comprador/perfilProducto/' . $idProducto, 'refresh');
	}
	function addCategoria($id = null)// Metodo encargado de agregar una categoria a la aplicacion.
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt_categoria', 'Nombre de la categoria', 'required|max_length[200]');
		if ($this->form_validation->run()) {
			$params = array(
				'categorias' => $this->input->post('txt_categoria')
			);
			if ($id != null) {
				if ($this->Tienda_model->editCategoria($id, $params)) {
					$this->message_display = "Categoria guardada correctamente.";
				} else {
					$this->error_message =  "Se ha producido un error al guardar la categoria.";
				}
			} else {
				if ($this->Tienda_model->addCategoria($params)) {
					$this->message_display = "Categoria guardada correctamente.";
				} else {
					$this->error_message =  "Se ha producido un error al guardar la categoria.";
				}
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
	function mantCategoria()// Metodo encaragdo de redirrecionar la aplicacion a la vista de mantenimiento de las categorias.
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
	function calificaciontienda($id)//Metodo encargado de calcular la calificacion de alguna tienda.
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
	function viewSuscriptores($id)// Metodo encargado redireccionar la aplicacion a la vista de visualizar los suscriptores de una tienda 
	{
		$suscriptores = $this->Tienda_model->getSuscriptoresTienda($id);
		$data['suscriptores'] = $suscriptores;
		$data['_view'] = "tienda/suscriptoresTienda";
		$this->load->view('layouts/main', $data);
	}
	function ventas($id, $FechaIni = null, $FechaFin = null)// Metodo que encargado de redirrecionar la aplicacion a la vista de reporte de ventas con los datos precargados.
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

	function buscarProductosReportes()//Metodo para filtrar productos en la vista de reporte de ventas.
	{
		$FechaInicial = $this->input->post('FechaInicial');
		$FechaFinal = $this->input->post('FechaFinal');
		if ($FechaInicial == "" and $FechaFinal == "") {
			$this->ventas($this->session->userdata['logged_in']['users_id']);
		} else {
			$this->ventas($this->session->userdata['logged_in']['users_id'], $FechaInicial, $FechaFinal);
		}
	}




	function compras($id, $FechaIni = null, $FechaFin = null)// Metodo que encargado de redirrecionar la aplicacion a la vista de reporte de compras con los datos precargados.
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
	function buscarProductosReportesCompras()//Metodo para filtrar productos en la vista de reporte de compras.
	{
		$FechaInicial = $this->input->post('FechaInicial');
		$FechaFinal = $this->input->post('FechaFinal');
		if ($FechaInicial == "" and $FechaFinal == "") {
			$this->compras($this->session->userdata['logged_in']['users_id']);
		} else {
			$this->compras($this->session->userdata['logged_in']['users_id'], $FechaInicial, $FechaFinal);
		}
	}

	function suscripciones($id)// Metodo que encargado de redirrecionar la aplicacion a la vista de reporte de suscripciones con los datos precargados.
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
	function getTiendasProductos($categoria = null, $FechaInicial = null, $FechaFinal = null, $precio = null)// Metodo que encargado de redirrecionar la aplicacion a la vista de reporte de ofertas con los datos precargados.
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
	function buscarProductosReportesOfertas()//Metodo para filtrar productos en la vista de reporte de ofertas.
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
