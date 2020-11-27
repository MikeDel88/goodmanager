<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Users_model
 * Permet d'interroger la base de données sur la table Users
 */
class Users_model extends MY_Model {

    public string $table;
    
    /**
     * __construct
     *
     * @return void Permet de définir le nom de la table
     */
    public function __construct(){
        parent::__construct();
        $this->table = 'users';
    }
    
    
    /**
     * selectToken
     *
     * @param  mixed $token
     * @return void Permet de récupérer un utilisateur en fonction de son token
     */
    public function selectToken(string $token){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('token', $token);
        return $this->db->get()->row();
    }
        
    /**
     * activation
     *
     * @param  int $id
     * @return void Permet d'activer un utilisateur
     */
    public function activation(int $id){
        $this->db->set('activate', 1);
        $this->db->where('id', $id);
        $this->db->update($this->table);
    }
    
    /**
     * reset
     *
     * @param  mixed $email
     * @param  array $data
     * @return void Permet de réinitialiser le mot de passe
     */
    public function reset(string $email, array $data){
        $this->db->set($data);
        $this->db->where('email', $email);
        $this->db->update($this->table);
    }


}