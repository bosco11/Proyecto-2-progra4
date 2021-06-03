<?php

Class Comprador extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Comprador_model');
	}

	//Muestra la vista del Login
	public function index($tweets_data = array()) {

		if ($tweets_data == null) {
            $data['tiendas'] = $this->Comprador_model->get_all_tiendas();
			$data['productos'] = $this->Comprador_model->get_all_productos();
			$data['galerias'] = $this->Comprador_model->get_all_galeria();
        } else {

        }
		$data['_view'] = 'comprador/compradorHome';
		$this->load->view('layouts/main',$data);
		// $this->load_data_view('comprador/compradorHome');
	}
	function compradorHome(){
		$this->index();
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

?>