<?php

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model');
    }

    function index()
    {
        $data['_view'] = 'user/add';
        $data['message_display'] = 'Te has registrado exitosamente.';
        $this->load->view('layouts/main', $data);
    }
    function add()
    {
        $data['_view'] = 'user/add';
        $this->load->view('layouts/main', $data);
    }
    function social()
    {
        $this->load_data_view('user/social');
    }
    function load_data_view($view)
    {
        $this->load->model('Tienda_model');
        $data['direcciones'] = $this->User_model->get_directions($this->session->userdata['logged_in']['users_id']);
        $data['pagos'] = $this->User_model->get_forms_pay($this->session->userdata['logged_in']['users_id']);
        $data['social'] = $this->User_model->get_red_social($this->session->userdata['logged_in']['users_id']);
        $data['_view'] = $view;
        $this->load->view('layouts/main', $data);
    }

    function agregarUsuario()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('txt_usuario', 'Usuario', 'required|max_length[50]');
        $this->form_validation->set_rules('txt_clave', 'Contraseña', 'required|max_length[200]');
        $this->form_validation->set_rules('txt_nombre', 'Nombre', 'required|max_length[100]');
        $this->form_validation->set_rules('txt_telefono', 'Telefono', 'required|max_length[14]');
        $this->form_validation->set_rules('txt_correo', 'Correo', 'required|max_length[45]');
        $this->form_validation->set_rules('txt_cedula', 'Cedula', 'required|max_length[100]');
        $this->form_validation->set_rules('txt_pais', 'Pais', 'required|max_length[100]');

        if ($this->form_validation->run()) {
            $config['upload_path']          = './resources/files/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000; //2MB
            $config['overwrite']            = true;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('txt_file')) {
                $params = array(
                    'user' => $this->input->post('txt_usuario'),
                    'password' => password_hash($this->input->post('txt_clave'), PASSWORD_BCRYPT),
                    'nombre_real' => $this->input->post('txt_nombre'),
                    'telefono' => $this->input->post('txt_telefono'),
                    'correo' => $this->input->post('txt_correo'),
                    'cedula' => $this->input->post('txt_cedula'),
                    'pais' => $this->input->post('txt_pais'),
                    'tipo_usuario' => $this->input->post('cmb_tipo'),
                    'imagen' => 'unknown.jpg',
                );
            } else {
                $data = array('upload_data' => $this->upload->data());
                $params = array(
                    'user' => $this->input->post('txt_usuario'),
                    'password' => password_hash($this->input->post('txt_clave'), PASSWORD_BCRYPT),
                    'nombre_real' => $this->input->post('txt_nombre'),
                    'telefono' => $this->input->post('txt_telefono'),
                    'correo' => $this->input->post('txt_correo'),
                    'cedula' => $this->input->post('txt_cedula'),
                    'pais' => $this->input->post('txt_pais'),
                    'tipo_usuario' => $this->input->post('cmb_tipo'),
                    'imagen' => $this->upload->data('file_name'),
                );
            }

            $user_id = $this->User_model->add_user($params);

            $data['message_display'] = 'Te has registrado exitosamente.';
            // $this->load->view('user/add', $data);
            $this->index();
        } else {
            $data['_view'] = 'user/add';
            $this->load->view('layouts/main', $data);
        }
    }


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


    function delete($users_id)
    {
        $data['user'] = $this->User_model->get_user($users_id);

        if ($this->session->userdata['logged_in']['users_id'] == $data['user']['id_usuarios'])
            $this->User_model->delete_user($users_id);

        $this->session->sess_destroy();
        $data['message_display'] = 'Tu cuenta se ha eliminado exitosamente. ¡Vuelve pronto!';
        $this->load->view('auth/login', $data);
    }

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
            $this->session->set_flashdata('error', $error['error']);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $params = array(
                'photo' => $this->upload->data('file_name'),
            );

            $this->User_model->update_user($users_id, $params);

            $this->session->set_flashdata('success', "Archivo cargado al sistema exitosamente.");
        }

        redirect('user/edit/' . $users_id);
    }
}
