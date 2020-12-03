<?php
declare(strict_types = 1);
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Contact_model
 * Permet d'interroger la base de données sur la table contact
 */
class Contact_model extends MY_Model {

    private string $table = 'contact';
    
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

    public function deleteContact(array $data) :void{
        $this->db->where($data);
        $this->db->delete($this->getTable());
    }
}