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
    
    /**
     * deleteContact
     * Supprime un contact
     * @param  mixed $data
     * @return void
     */
    public function deleteContact(array $data) :void{
        $this->db->where($data);
        $this->db->delete($this->getTable());
    }
    
    /**
     * getContact
     * Récupère tous les contacts du jour d'un utilisateur
     * @return array
     */
    public function getContact() :array{

        $this->db->select('*');
        $this->db->from($this->getTable());
        $this->db->where('user_id', $this->session->session_id);
        $this->db->where('date', date('Y-m-d'));
        $query = $this->db->get();
        return $query->custom_result_object('Contact');
    }
    
    /**
     * getHistoryContact
     *  Récupère l'ensemble de l'historique des contacts d'un client
     * @param  mixed $id
     * @return void
     */
    public function getHistoryContact($id){
        $this->db->select('*');
        $this->db->from($this->getTable());
        $this->db->where('client_id', $id);
        $this->db->join('users', "users.id = {$this->getTable()}.user_id");
        $this->db->order_by('date', 'DESC');
        return $this->db->get()->result();
    }
    
    /**
     * selectContactParUtilisateur
     *  Retourne le nombre de contact réalisé par un utilisateur pour le dashboard
     * @return array
     */
    public function selectContactParUtilisateur() :array{
        $year = date("Y");
        $query = $this->db->query("SELECT users.nom, users.prenom, COUNT(contact.user_id) as nombre FROM {$this->getTable()}, users WHERE contact.user_id = users.id AND YEAR(date) = $year AND users.entreprise_id = {$this->session->entreprise_id} GROUP BY user_id");
        return $query->result();
    }
}