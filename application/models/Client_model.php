<?php
declare(strict_types = 1);
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Client_model
 * Permet d'interroger la base de données sur la table client
 */
class Client_model extends MY_Model {

    private string $table = 'client';
    
    /**
     * __construct
     *
     * @return void Permet de définir le nom de la table
     */
    public function __construct(){
        parent::__construct();
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

    public function getClientBy(string $field, string $data){

        $this->db->select('*');
        $this->db->from($this->getTable());
        $this->db->where('entreprise_id', $this->session->entreprise_id);
        $this->db->where($field, $data);
        return $this->db->get()->custom_result_object('Client');
        
    }
}