<?php
declare(strict_types = 1);
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Users_model
 * Permet d'interroger la base de données sur la table Users
 */
class Users_model extends MY_Model {

    private string $table = 'users';
    
    /**
     * __construct
     *
     * @return void Permet de définir le nom de la table
     */
    public function __construct(){
        parent::__construct();
    }
    
    
    /**
     * selectToken
     *
     * @param  string $token
     * @return void Permet de récupérer un utilisateur en fonction de son token
     */
    public function selectToken(string $token){
        $this->db->select('*');
        $this->db->from($this->getTable());
        $this->db->where('token', $token);
        return $this->db->get()->custom_row_object(0, 'User');
    }
        
    
    /**
     * activation
     *
     * @param  int $id
     * @return void
     */
    public function activation(int $id){
        $this->db->set('activate', 1);
        $this->db->where('id', $id);
        $this->db->update($this->getTable());
    }
    
    
    /**
     * reset
     *
     * @param  string $email
     * @param  array $data
     * @return void
     */
    public function reset(string $email, array $data){
        $this->db->set($data);
        $this->db->where('email', $email);
        $this->db->update($this->getTable());
    }
    
    /**
     * getTable
     *
     * @return string
     * Retourne le nom de la table
     */
    public function getTable() :string{
        return $this->table;
    }


}