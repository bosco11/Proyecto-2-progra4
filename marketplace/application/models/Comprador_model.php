<?php

class Comprador_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_all_tiendas()
    {
        return $this->db->query("SELECT *
                                FROM tbl_usuarios
                                WHERE tbl_usuarios.tipo_usuario = 'Tienda'
                                ORDER BY tbl_usuarios.nombre_real ASC")->result_array();

    }

    public function get_all_productos()
    {
        return $this->db->query("SELECT *
                                FROM tbl_productos
                                ")->result_array();
    }
    
    
    public function get_all_galeria()
    {
        return $this->db->query("SELECT *
                                FROM tbl_galeria
                                ")->result_array();
    }

    // public function add_tweet($params)
    // {
    //     $this->db->insert('tweets',$params);
    //     return $this->db->insert_id();
    // }

    // public function edit_tweet($params)
    // {
    //     return $this->db->query("UPDATE tweets SET tweets.post = '". $params['post'] ."' WHERE tweets.tweets_id = " . $params['tweets_id']);
    // }

    // public function edit_tweetImg($params)
    // {
    //     return $this->db->query("UPDATE tweets SET tweets.post = '". $params['post'] ."', tweets.img = '". $params['img'] ."' WHERE tweets.tweets_id = " . $params['tweets_id']);
    // }

    // public function delete_tweet($id)
    // {
    //     $this->db->delete('tweets', array('tweets_id' => $id));
    // }

    // function likeDislikeUpdate($params)
    // {
    //     return $this->db->query("UPDATE reacciones SET reacciones.reaccion = '". $params['reaccion'] ."' where reacciones.users_users_id = '". $params['users_users_id'] ."' and reacciones.tweets_tweets_id = " . $params['tweets_tweets_id']);
    // }

    // public function reaccionUsuarioUnica($idUsuario,$idpost)
    // {
    //     return $this->db->query("SELECT reacciones.reaccion
    //                             FROM  reacciones
    //                             WHERE reacciones.tweets_tweets_id = '".$idpost."' and reacciones.users_users_id = '".$idUsuario."'")->result_array();
    // }
}
