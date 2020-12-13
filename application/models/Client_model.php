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
    
    /**
     * getClientBy
     * Récupère une liste de client en fonction d'une recherche effectuée aproximative
     * @param  string $field
     * @param  string $data
     * @return void
     */
    public function getClientBy(string $field, string $data){

        $this->db->select('*');
        $this->db->from($this->getTable());
        $this->db->where('entreprise_id', $this->session->entreprise_id);
        $this->db->like($field, $data, 'after');
        return $this->db->get()->custom_result_object('Client');
        
    }
    
    /**
     * getGeolocalisationClients
     * Permet de récupérer la liste des clients dans le périmètre sélectionné
     * @param  mixed $lat
     * @param  mixed $lng
     * @param  mixed $distance
     * @return void
     */
    public function getGeolocalisationClients($lat, $lng,$distance){

        $sql = "SELECT id, last_name, first_name, lat, lng, ( 6371 * acos( cos( radians(".$this->db->escape($lat).") ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(".$this->db->escape($lng).") ) + sin( radians(".$this->db->escape($lat).") ) * sin( radians( lat ) ) ) ) AS distance FROM {$this->getTable()} HAVING distance < ".$this->db->escape($distance)." ORDER BY distance";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     * deleteAllUsers
     *  Si l'admin décide de supprimer son compte, il supprime également l'ensemble des sous_comptes non admin relié à l'entreprise
     * @param  int $entrepriseId
     * @return void
     */
    public function deleteAllUsers(int $entrepriseId){
        $this->db->where('entreprise_id', $entrepriseId);
        $this->db->delete($this->getTable());
    }
    
    /**
     * selectNewClientByYear
     *  Récupère l'ensemble des nouveaux clients d'une année
     * @return void
     */
    public function selectNewClientByYear(){
        $query = $this->db->query("SELECT YEAR(created_at) as annee, COUNT(id) as nbrClients FROM {$this->getTable()} WHERE entreprise_id = {$this->session->entreprise_id} GROUP BY YEAR(created_at)");
        return $query->result();
    }
    
    /**
     * selectNumberClientByYear
     * Récupère le nombre de client par an
     * @param  mixed $year
     * @return void
     */
    public function selectNumberClientByYear($year){
        $query = $this->db->query("SELECT COUNT(id) as nbrClients FROM {$this->getTable()} WHERE entreprise_id = {$this->session->entreprise_id} AND YEAR(created_at) <= $year");
        $row = $query->row();
        return $row->nbrClients;
    }
    
    /**
     * selectNombreClientByDept
     *  Récupère le nombre de client par département
     * @return void
     */
    public function selectNombreClientByDept(){
        $query = $this->db->query("SELECT SUBSTRING(zipcode,1, 2) as code , COUNT(id) as nbrClients FROM {$this->getTable()} WHERE entreprise_id = {$this->session->entreprise_id} GROUP BY code");
        return $query->result();
    }
    
    /**
     * selectSansInfo
     *  Récupère l'ensemble des clients sans informations (mail, tél)
     * @param  mixed $info
     * @return void
     */
    public function selectSansInfo(string $info){
        $query = $this->db->query("SELECT count(id) as $info FROM {$this->getTable()} WHERE $info = ' ' AND entreprise_id = {$this->session->entreprise_id}");
        $row = $query->row();
        return $row->$info;
    }
    
    /**
     * selectSansTelNiMail
     *  Récupère l'ensemble des clients sans téléphone ni adresse email
     * @param  mixed $tel
     * @param  mixed $mail
     * @return void
     */
    public function selectSansTelNiMail(string $tel, string $mail){
        $query = $this->db->query("SELECT count(id) as sansTelNiMail FROM {$this->getTable()} WHERE $tel = '' AND $mail = '' AND entreprise_id = {$this->session->entreprise_id}");
        $row = $query->row();
        return $row->sansTelNiMail;
    }

}