<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Entreprise_model
 * Permet d'interroger la base de données sur la table entreprise
 */
class Entreprise_model extends MY_Model {

    public string $table;
    
    /**
     * __construct
     *
     * @return void Permet de définir le nom de la table
     */
    public function __construct(){
        parent::__construct();
        $this->table = 'entreprise';
    }
    
    /**
     * register
     *
     * @param  array $data
     * @return void Permet d'enregistrer un utilisateur
     */
    public function register(array $data): int{
        $this->insert($data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

}