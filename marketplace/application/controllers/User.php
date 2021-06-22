<?php

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model');
        $this->load->model('Comprador_model');
    }
    // Redirige a la vista de inserccion de asuarios
    function index()
    {
        $data['_view'] = 'user/add';
        $data['message_display'] = 'Te has registrado exitosamente.';
        $this->load->view('layouts/main', $data);
    }
    //Redirige a la vista de inserccion de asuarios la primera vez que se ingresa
    function add()
    {
        $data['_view'] = 'user/add';
        $this->load->view('layouts/main', $data);
    }
    //Invoca al metodo que Redirige a la vista de inserccion direcciones, redes y formas de pago
    function social()
    {
        $this->load_data_view('user/social');
    }
    // Redirige a la vista de inserccion direcciones, redes y formas de pago inicialmente
    function load_data_view($view)
    {
        $this->load->model('Tienda_model');
        $data['direcciones'] = $this->User_model->get_directions($this->session->userdata['logged_in']['users_id']);
        $data['pagos'] = $this->User_model->get_forms_pay($this->session->userdata['logged_in']['users_id']);
        $data['social'] = $this->User_model->get_red_social($this->session->userdata['logged_in']['users_id']);
        $data['pagos2'] = null;
        $data['direcciones2'] = null;
        $data['social2'] = null;
        $data['message_display'] = null;
        $data['error_message'] = null;
        $data['_view'] = $view;
        $this->load->view('layouts/main', $data);
    }
    // Funcion que redirige a una vista y carga datos que recibe por parametrso
    function load_data_user($view, $data)
    {
        $data['_view'] = $view;
        $this->load->view('layouts/main', $data);
    }
    // Redirige a la vista de inserccion direcciones, redes y formas de pago cuando se elige editar en el boton o cuando se ingresa datos
    function load_data_view2($view, $mess)
    {
        $this->load->model('Tienda_model');
        $data['direcciones'] = $this->User_model->get_directions($this->session->userdata['logged_in']['users_id']);
        $data['pagos'] = $this->User_model->get_forms_pay($this->session->userdata['logged_in']['users_id']);
        $data['social'] = $this->User_model->get_red_social($this->session->userdata['logged_in']['users_id']);
        $data['pagos2'] = $mess['pagos2'];
        $data['direcciones2'] = $mess['direcciones2'];
        $data['social2'] = $mess['social2'];
        $data['_view'] = $view;
        $data['message_display'] = $mess['message_display'];
        $data['error_message'] = $mess['error_message'];
        $this->load->view('layouts/main', $data);
    }
    // Funcion para agregar usuarios
    function agregarUsuario()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('txt_usuario', 'Usuario', 'required|max_length[50]');
        $this->form_validation->set_rules('txt_clave', 'Contraseña', 'required|max_length[200]');
        $this->form_validation->set_rules('txt_nombre', 'Nombre', 'required|max_length[100]');
        $this->form_validation->set_rules('txt_telefono', 'Telefono', 'required|max_length[14]');
        $this->form_validation->set_rules('txt_correo', 'Correo', 'required|max_length[45]');
        $this->form_validation->set_rules('txt_cedula', 'Cedula', 'required|max_length[12]');
        $this->form_validation->set_rules('txt_pais', 'Pais', 'required|max_length[100]');
        $this->form_validation->set_rules('txt_direccion', 'Direccion', 'required|max_length[200]');
        // Ingresa al if si todas las reglas cumplen, sino  se devuelve a la vista notificando el error
        if ($this->form_validation->run()) {

            $params = array(
                'user' => $this->input->post('txt_usuario'),
                'password' => password_hash($this->input->post('txt_clave'), PASSWORD_BCRYPT),
                'nombre_real' => $this->input->post('txt_nombre'),
                'telefono' => $this->input->post('txt_telefono'),
                'correo' => $this->input->post('txt_correo'),
                'cedula' => $this->input->post('txt_cedula'),
                'pais' => $this->input->post('txt_pais'),
                'tipo_usuario' => $this->input->post('cmb_tipo'),
                'direccion' => $this->input->post('txt_direccion'),
                'imagen' => 'unknown.jpg'
            );
            $user_id = $this->User_model->add_user($params);

            $data['message_display'] = 'Te has registrado exitosamente.';
            $this->index();
        } else {
            $data['_view'] = 'user/add';
            $this->load->view('layouts/main', $data);
        }
    }

    // Funcion para editar un usuario
    function edit($users_id)
    {
        $data['user'] = $this->User_model->get_user($users_id);

        if (isset($data['user']['id_usuarios']) && $this->session->userdata['logged_in']['users_id'] == $data['user']['id_usuarios']) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('txt_usuario', 'Usuario', 'required|max_length[50]');
            $this->form_validation->set_rules('txt_clave', 'Contraseña', 'required|max_length[200]');
            $this->form_validation->set_rules('txt_nombre', 'Nombre', 'required|max_length[100]');
            $this->form_validation->set_rules('txt_telefono', 'Telefono', 'required|max_length[14]');
            $this->form_validation->set_rules('txt_correo', 'Correo', 'required|max_length[45]');
            $this->form_validation->set_rules('txt_cedula', 'Cedula', 'required|max_length[100]');
            $this->form_validation->set_rules('txt_pais', 'Pais', 'required|max_length[100]');
            $this->form_validation->set_rules('txt_direccion', 'Direccion', 'required|max_length[200]');
            // Ingresa al if si todas las reglas cumplen, sino  se devuelve a la vista notificando el error
            if ($this->form_validation->run()) {
                $params = array(
                    'user' => $this->input->post('txt_usuario'),
                    'password' => password_hash($this->input->post('txt_clave'), PASSWORD_BCRYPT),
                    'nombre_real' => $this->input->post('txt_nombre'),
                    'telefono' => $this->input->post('txt_telefono'),
                    'correo' => $this->input->post('txt_correo'),
                    'cedula' => $this->input->post('txt_cedula'),
                    'pais' => $this->input->post('txt_pais'),
                    'direccion' => $this->input->post('txt_direccion'),
                    'tipo_usuario' => $this->input->post('cmb_tipo'),
                );

                $this->User_model->update_user($users_id, $params);

                $this->session->set_flashdata('success', "Tus datos de usuario se han actualizado. Vuelve a autenticarte para ver los cambios.");

                $data['_view'] = 'user/edit';
                $this->load->view('layouts/main', $data);
            } else {
                $data['_view'] = 'user/edit';
                $this->load->view('layouts/main', $data);
            }
        } else {
            if ($this->session->userdata['logged_in']['tipo'] == 'Comprador') {

                redirect('comprador/compradorHome');
            } else {
                redirect('tienda/tiendaHome');
            }
        }
    }
    // Funcion que permite eliminar un usuario
    function delete($users_id)
    {
        $data['user'] = $this->User_model->get_user($users_id);
        if ($this->session->userdata['logged_in']['users_id'] == $data['user']['id_usuarios']) {           
            try {
                $user = $this->User_model->delete_user($users_id);
                if (!$user) {//Si ocurre un error al eliminar un  usuario producimos una exepccion y le notificamos al usuario
                    throw new exception();
                } else {
                    $this->session->sess_destroy();
                    $data['message_display'] = 'Tu cuenta se ha eliminado exitosamente. ¡Vuelve pronto!';
                    $this->load->view('auth/login', $data);
                }
            } catch (Exception $e) {
                $this->session->set_flashdata('error', "La cuenta no se puede eliminar, debido a que los datos se encuentran en otros registros");
                $data['_view'] = 'user/edit';
                $this->load->view('layouts/main', $data);
            }
        }
    }
    // Funcion que permite actulizar una foto del usuario
    function upload_photo($users_id)
    {
        $config['upload_path']          = './resources/photos/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2000; //2MB
        $config['file_name']           = $users_id;
        $config['overwrite']            = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('txt_file')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', 'No ha seleccionado una imagen para cargar en el sistema');
        } else {
            $data = array('upload_data' => $this->upload->data());
            $params = array(
                'imagen' => $this->upload->data('file_name'),
            );

            $this->User_model->update_user($users_id, $params);
            $this->session->userdata['logged_in']['imagen'] = $this->upload->data('file_name');

            $this->session->set_flashdata('success', "Archivo cargado al sistema exitosamente.");
        }

        redirect('user/edit/' . $users_id);
    }
    // Funcion para agregar y editar un usuario
    function agregarmetodo()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('txt_propietario', 'Dueño', 'required|max_length[200]');
        $this->form_validation->set_rules('txt_numero', 'Numero', 'required|max_length[16]');
        $this->form_validation->set_rules('txt_codigo', 'CVV', 'required|max_length[3]');
        $this->form_validation->set_rules('vencimiento', 'fecha', 'required');
        $this->form_validation->set_rules('txt_saldo', 'saldo', 'required');

        if (isset($_POST['btn_save'])) {//Se ingresa si se seleccionó el boton de guardar

            if ($this->form_validation->run()) {

                $params = array(
                    'nombre_dueno' => $this->input->post('txt_propietario'),
                    'numero_tarjeta' => $this->input->post('txt_numero'),
                    'cvv' => password_hash($this->input->post('txt_codigo'), PASSWORD_BCRYPT),
                    'fecha_vencimiento' => $this->input->post('vencimiento'),
                    'saldo' => $this->input->post('txt_saldo'),
                    'id_usuarios' => $this->session->userdata['logged_in']['users_id'],

                );


                $user_id = $this->User_model->add_pay($params);

                $data['message_display'] = 'Ha registrado el metodo de pago correctamente.';
                $data['error_message'] = null;
                $data['pagos2'] = null;
                $data['direcciones2'] = null;
                $data['social2'] = null;
                $this->load_data_view2('user/social', $data);
            } else {//Ingresa si ocurre un error con insertar un metodo de pago
                $data['message_display'] = null;
                $data['error_message'] = null;
                $data['pagos2'] = null;
                $data['direcciones2'] = null;
                $data['social2'] = null;
                $data['_view'] = 'user/social';
                $this->load->view('layouts/main', $data);
            }
        } else {//Ingresa si se selecciona al boton de actualizar 
            if ($this->form_validation->run()) {
                $params = array(
                    'nombre_dueno' => $this->input->post('txt_propietario'),
                    'numero_tarjeta' => $this->input->post('txt_numero'),
                    'cvv' => password_hash($this->input->post('txt_codigo'), PASSWORD_BCRYPT),
                    'fecha_vencimiento' => $this->input->post('vencimiento'),
                    'saldo' => $this->input->post('txt_saldo')

                );

                $user_id = $this->User_model->update_pay($this->input->post('btn_edit'), $params);

                $data['message_display'] = 'Ha actualizado el metodo de pago correctamente.';
                $data['pagos2'] = null;
                $data['error_message'] = null;
                $data['direcciones2'] = null;
                $data['social2'] = null;
                $this->load_data_view2('user/social', $data);
            } else {//Ingresa si ocurre un error con actualizar un metodo de pago
                $data['message_display'] = null;
                $data['error_message'] = null;
                $data['pagos2'] = null;
                $data['direcciones2'] = null;
                $data['social2'] = null;
                $data['_view'] = 'user/social';
                $this->load->view('layouts/main', $data);
            }
        }
    }
    // Funcion para eliminar un metodo de pago
    function delete_metodos($pay_id)
    {
        try {
            $data['pay'] = $this->User_model->get_form_pay($pay_id);
            $pago = $this->User_model->delete_pay($pay_id);
            if (!$pago) {//Si ocurre un error en el proceso de eliminacion  se crea una excepcion
                throw new exception();
            } else {//Si todo se ejecutó bien se le notifica al usuario
                $data['message_display'] = 'Se ha eliminado el metodo de pago!';
                $data['error_message'] = null;
                $data['pagos2'] = null;
                $data['direcciones2'] = null;
                $data['social2'] = null;
                $this->load_data_view2('user/social', $data);
            }
        } catch (Exception $e) {//Si ocurrió un error se le notifica al usuario
            $data['error_message']  = 'Este metodo de pago no se puede eliminar, debido a que los datos se encuentran en otros registros';
            $data['pagos2'] = null;
            $data['direcciones2'] = null;
            $data['social2'] = null;
            $data['message_display'] = null;
            $this->load_data_view2('user/social', $data);
        }
    }
    // Funcion para verificar se si presiona el boton de eliminar o editar
    function mantmetodo($id)
    {
        if (isset($_POST['btn_elim'])) {
            $this->delete_metodos($id);
        } else {
            $data['pay'] = $this->User_model->get_form_pay($id);
            $data['message_display'] = null;
            $data['error_message'] = null;
            $data['pagos2'] = $data['pay'];
            $data['direcciones2'] = null;
            $data['social2'] = null;
            $this->load_data_view2('user/social', $data);
        }
    }
    // Funcion para agregar una direccion 
    function agregarDireccion()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('txt_pais', 'Pais', 'required|max_length[200]');
        $this->form_validation->set_rules('txt_provincia', 'Provincia', 'required|max_length[200]');
        $this->form_validation->set_rules('txt_casillero', 'Casillero', 'required|max_length[200]');
        $this->form_validation->set_rules('txt_postal', 'Postal', 'required|max_length[100]');
        $this->form_validation->set_rules('txt_observaciones', 'Observaciones', 'required|max_length[300]');

        if (isset($_POST['btn_save'])) {//Se verifica si se le da clic en guardar
            if ($this->form_validation->run()) {//Ingresa si las reglas se cumplen

                $params = array(
                    'pais_direccion' => $this->input->post('txt_pais'),
                    'provincia' => $this->input->post('txt_provincia'),
                    'numero_casillero' => $this->input->post('txt_casillero'),
                    'codigo_postal' => $this->input->post('txt_postal'),
                    'observaciones' => $this->input->post('txt_observaciones'),
                    'id_usuarios' => $this->session->userdata['logged_in']['users_id'],

                );
                $user_id = $this->User_model->add_direction($params);

                $data['message_display'] = 'Ha registrado la dirección correctamente.';
                $data['error_message'] = null;
                $data['pagos2'] = null;
                $data['direcciones2'] = null;
                $data['social2'] = null;
                $this->load_data_view2('user/social', $data);
            } else {//se le notifica al cliente si ocurre un error
                $data['message_display'] = null;
                $data['error_message'] = null;
                $data['pagos2'] = null;
                $data['direcciones2'] = null;
                $data['social2'] = null;
                $data['_view'] = 'user/social';
                $this->load->view('layouts/main', $data);
            }
        } else {//ingresa si se le da clic en el boton de actualizar
            if ($this->form_validation->run()) {

                $params = array(
                    'pais_direccion' => $this->input->post('txt_pais'),
                    'provincia' => $this->input->post('txt_provincia'),
                    'numero_casillero' => $this->input->post('txt_casillero'),
                    'codigo_postal' => $this->input->post('txt_postal'),
                    'observaciones' => $this->input->post('txt_observaciones')

                );
                $user_id = $this->User_model->update_direction($this->input->post('btn_edit'), $params);
                $data['message_display'] = 'Ha actualizado la dirección correctamente.';
                $data['error_message'] = null;
                $data['pagos2'] = null;
                $data['direcciones2'] = null;
                $data['social2'] = null;
                $this->load_data_view2('user/social', $data);

            } else {//se le notifica al cliente si ocurre un error
                $data['message_display'] = null;
                $data['error_message'] = null;
                $data['pagos2'] = null;
                $data['direcciones2'] = null;
                $data['social2'] = null;
                $data['_view'] = 'user/social';
                $this->load->view('layouts/main', $data);
            }
        }
    }
        // Funcion para eliminar una direccion
    function delete_direccion($dir_id)
    {
        try {
            $data['dir'] = $this->User_model->get_direction($dir_id);
            $direction = $this->User_model->delete_direction($dir_id);
            if (!$direction) {//Ingresa si ocurre un error en el procedo de eliminar
                throw new exception();
            } else {//se le notifica al cliente si todo fué correcto
                $data['pagos2'] = null;
                $data['direcciones2'] = null;
                $data['social2'] = null;
                $data['message_display'] = 'Se ha eliminado la dirección!';
                $data['error_message'] = null;
                $this->load_data_view2('user/social', $data);
            }
        } catch (Exception $e) {//se le notifica al cliente si ocurre un error
            $data['pagos2'] = null;
            $data['direcciones2'] = null;
            $data['social2'] = null;
            $data['message_display'] = null;
            $data['error_message'] = 'La dirección no se puede eliminar, debido a que los datos se encuentran en otros registros';
            $this->load_data_view2('user/social', $data);
        }
    }
    // Funcion para verificar se si presiona el boton de eliminar o editar
    function mantDir($dir_id)
    {
        if (isset($_POST['btn_elim'])) {
            $this->delete_direccion($dir_id);
        } else {

            $data['dir'] = $this->User_model->get_direction($dir_id);
            $data['message_display'] = null;
            $data['error_message'] = null;
            $data['pagos2'] = null;
            $data['direcciones2'] = $data['dir'];
            $data['social2'] = null;
            $this->load_data_view2('user/social', $data);
        }
    }
    // Funcion para insertar una red social
    function agregarRed()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('txt_red', 'Red', 'required|max_length[64]');
        $this->form_validation->set_rules('txt_usuario', 'Usuario', 'required|max_length[150]');

        if (isset($_POST['btn_save'])) {//se verifica si se selleccionó el boton de guardar
            if ($this->form_validation->run()) {//verifica si se cumplen las reglas
                $params = array(
                    'red_social' => $this->input->post('txt_red'),
                    'nombre_usuario' => $this->input->post('txt_usuario'),
                    'id_usuarios' => $this->session->userdata['logged_in']['users_id'],
                );
                $user_id = $this->User_model->add_red($params);

                $data['message_display'] = 'Ha registrado la red social correctamente.';
                $data['error_message'] = null;
                $data['pagos2'] = null;
                $data['direcciones2'] = null;
                $data['social2'] = null;
                $this->load_data_view2('user/social', $data);

            } else {//se le notifica al cliente si ocurre un error
                $data['message_display'] = null;
                $data['error_message'] = null;
                $data['pagos2'] = null;
                $data['direcciones2'] = null;
                $data['social2'] = null;
                $data['_view'] = 'user/social';
                $this->load->view('layouts/main', $data);
            }
        } else {//ingresa si se intenta editar una red social
            if ($this->form_validation->run()) {//verifica si se cumplen las reglas
                $params = array(
                    'red_social' => $this->input->post('txt_red'),
                    'nombre_usuario' => $this->input->post('txt_usuario'),
                );
                $user_id = $this->User_model->update_red($this->input->post('btn_edit'), $params);

                $data['message_display'] = 'Ha actualizado la red social correctamente.';
                $data['error_message'] = null;
                $data['pagos2'] = null;
                $data['direcciones2'] = null;
                $data['social2'] = null;
                $this->load_data_view2('user/social', $data);
            } else {//se le notifica al cliente si ocurre un error
                $data['message_display'] = null;
                $data['error_message'] = null;
                $data['pagos2'] = null;
                $data['direcciones2'] = null;
                $data['social2'] = null;
                $data['_view'] = 'user/social';
                $this->load->view('layouts/main', $data);
            }
        }
    }
    // Funcion para eliminar una red social
    function delete_red($red_id)
    {
        try {
            $data['dir'] = $this->User_model->get_red($red_id);
            $redes = $this->User_model->delete_red($red_id);
            if (!$redes) {//ingresa si ocurre un error en elproceso de eliminacion
                throw new exception();
            } else {//se le notifica al cliente si todo esta correcto
                $data['pagos2'] = null;
                $data['direcciones2'] = null;
                $data['social2'] = null;
                $data['message_display'] = 'Se ha eliminado la red social!';
                $data['error_message'] = null;
                $this->load_data_view2('user/social', $data);
            }
        } catch (Exception $e) {//se le notifica al cliente si ocurre un error
            $this->session->set_flashdata('error', "La cuenta no se puede eliminar, debido a que los datos se encuentran en otros registros");
            $data['pagos2'] = null;
            $data['direcciones2'] = null;
            $data['social2'] = null;
            $data['message_display'] = null;
            $data['error_message'] = 'La red social no se puede eliminar, debido a que los datos se encuentran en otros registros';
            $this->load_data_view2('user/social', $data);
        }
    }
    // Funcion para verificar se si presiona el boton de eliminar o editar
    function mantRed($id)
    {
        if (isset($_POST['btn_elim'])) {
            $this->delete_red($id);
        } else {
            $data['red'] = $this->User_model->get_red($id);
            $data['message_display'] = null;
            $data['error_message'] = null;
            $data['pagos2'] = null;
            $data['direcciones2'] = null;
            $data['social2'] = $data['red'];
            $this->load_data_view2('user/social', $data);
        }
    }
    // Funcion para redirigir a la vista perfil de usuario
    function perfilUsuario($users_id)
    {
        $data['carrito'] = $this->Comprador_model->get_all_carrito_deseo($users_id, 'D');//Se obtiene los productos deseados
        $data['suscripciones'] = $this->User_model->getTiendas_Suscritas($users_id);//Se obtiene las tiendas suscritas

        if (isset($this->session->userdata['logged_in'])) {//Se verifica si el usuario inició sesion
            $data['seccion'] = $this->session->userdata['logged_in'];
            $data['user'] = $this->User_model->get_user($users_id);//se obtiene la informacion del usuario
        } else {
            $data['seccion'] = false;
        }

        $this->load_data_user('comprador/perfilComprador', $data);
    }
}
