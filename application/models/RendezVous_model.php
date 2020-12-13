<?php
declare(strict_types = 1);
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * RendezVous_model
 * Permet d'interroger la base de données sur la table rendez-vous
 */
class RendezVous_model extends MY_Model {

    private string $table = 'rdv';
    
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

    public function selectAllRdv(){
        $this->db->select('*');
        $this->db->from($this->getTable());
        $this->db->join('client', "client.id = {$this->getTable()}.client_id");
        $this->db->where('client.entreprise_id', $this->session->entreprise_id);
        $this->db->where('user_id', $this->session->session_id);
        return $this->db->get()->result();
    }

    public function deleteRDV(int $id){
        $this->db->where('rdv_id', $id);
        $this->db->delete($this->getTable());
    }

    public function updateRDV(array $data, int $id){
        $this->db->set($data);
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('rdv_id', $id);
        $this->db->update($this->getTable());
    }

    public function nombreRdvPrisParUtilisateur(){
        $year = date("Y");
        $query = $this->db->query("SELECT users.last_name, users.first_name, COUNT(rdv.user_id) as nombre FROM rdv, users WHERE rdv.user_id = users.id AND YEAR(date) = $year AND users.entreprise_id = {$this->session->entreprise_id} GROUP BY rdv.user_id");
        return $query->result();
    }
}