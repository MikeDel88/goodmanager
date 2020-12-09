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
        $this->db->like($field, $data, 'after');
        return $this->db->get()->custom_result_object('Client');
        
    }

    public function getGeolocalisationClients($lat, $lng,$distance){

        $sql = "SELECT id, last_name, first_name, lat, lng, ( 6371 * acos( cos( radians(".$this->db->escape($lat).") ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(".$this->db->escape($lng).") ) + sin( radians(".$this->db->escape($lat).") ) * sin( radians( lat ) ) ) ) AS distance FROM {$this->getTable()} HAVING distance < ".$this->db->escape($distance)." ORDER BY distance";
        $query = $this->db->query($sql);
        return $query->result();
    }
}