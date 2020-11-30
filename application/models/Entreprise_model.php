<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Entreprise_model
 * Permet d'interroger la base de données sur la table entreprise
 */
class Entreprise_model extends MY_Model {

    private string $table = 'entreprise';
    
    /**
     * __construct
     *
     * @return void Permet de définir le nom de la table
     */
    public function __construct(){
        parent::__construct();
    }
    
    
    /**
     * register
     *
     * @param  mixed $data
     * @return int 
     * Permet d'enregistrer une entreprise lors de la création d'un utilisateur
     */
    public function register(array $data) :int{
        $this->insert($data);
        $last_id = $this->db->insert_id();
        return $last_id;
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