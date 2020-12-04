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

    public function getContact(){

        $this->db->select('*');
        $this->db->from($this->getTable());
        $this->db->where('user_id', $this->session->session_id);
        $this->db->where('date', date('Y-m-d'));
        $query = $this->db->get();
        return $query->custom_result_object('Contact');
    }

    public function getHistoryContact($id){
        $this->db->select('date');
        $this->db->from($this->getTable());
        $this->db->where('client_id', $id);
        $this->db->order_by('date', 'DESC');
        return $this->db->get()->result();
    }
}