<?php
declare(strict_types = 1);
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * RendezVous_model
 * Permet d'interroger la base de données sur la table rendez-vous
 */
class RendezVous_model extends MY_Model
{
    private string $table = 'rdv';
    
    /**
     * __construct
     *
     * @return void Permet de définir le nom de la table
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * getTable
     *
     * @return string
     * Retourne le nom de la table
     */
    public function getTable() :string
    {
        return $this->table;
    }
    
    /**
     * selectAllRdv
     *  Retourne l'ensemble des rendez-vous d'un utilisateur
     * @return array
     */
    public function selectAllRdv() :array
    {
        $this->db->select('*');
        $this->db->from($this->getTable());
        $this->db->join('client', "client.id = {$this->getTable()}.client_id");
        $this->db->where('client.entreprise_id', $this->session->entreprise_id);
        $this->db->where('utilisateur_id', $this->session->session_id);
        return $this->db->get()->result();
    }
    
    /**
     * deleteRDV
     *  Supprime un rendez-vous
     * @param  mixed $id
     * @return void
     */
    public function deleteRDV(int $id)
    {
        $this->db->where('rdv_id', $id);
        $this->db->delete($this->getTable());
    }
    
    /**
     * updateRDV
     *  Mets à jour un rendez-vous
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateRDV(array $data, int $id)
    {
        $this->db->set($data);
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('rdv_id', $id);
        $this->db->update($this->getTable());
    }
    
    /**
     * nombreRdvPrisParUtilisateur
     *  Retourne le nombre de Rendez vous pris par un utilisateur pour le dashboard
     * @return array
     */
    public function nombreRdvPrisParUtilisateur() :array
    {
        $year = date("Y");
        $query = $this->db->query("SELECT utilisateur.nom, utilisateur.prenom, COUNT(rdv.utilisateur_id) as nombre FROM rdv, utilisateur WHERE rdv.utilisateur_id = utilisateur.id AND YEAR(date) = $year AND utilisateur.entreprise_id = {$this->session->entreprise_id} GROUP BY rdv.utilisateur_id");
        return $query->result();
    }
}
