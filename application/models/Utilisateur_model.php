<?php
declare(strict_types = 1);
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * Utilisateur_model
 * Permet d'interroger la base de données sur la table Utilisateur
 */
class Utilisateur_model extends MY_Model
{
    private string $table = 'utilisateur';
    
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
     * selectToken
     *
     * @param  string $token
     * @return object Permet de récupérer un utilisateur en fonction de son token
     */
    public function selectToken(string $token) :object
    {
        $this->db->select('*');
        $this->db->from($this->getTable());
        $this->db->where('token', $token);
        return $this->db->get()->custom_row_object(0, 'Utilisateur');
    }
        
    
    /**
     * activation
     *
     * @param  int $id
     * @return void
     */
    public function activation(int $id) :void
    {
        $this->db->set('active', 1);
        $this->db->where('id', $id);
        $this->db->update($this->getTable());
    }
    
    
    /**
     * reset
     *
     * @param  string $email
     * @param  array $data
     * @return void
     */
    public function reset(string $email, array $data) :void
    {
        $this->db->set($data);
        $this->db->where('email', $email);
        $this->db->update($this->getTable());
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
     * getUtilisateur
     *  Récupère tous les collaborateurs d'une entreprise
     * @param  mixed $entrepriseId
     * @return array
     */
    public function getUtilisateur($entrepriseId) :array
    {
        $this->db->select('*');
        $this->db->from($this->getTable());
        $this->db->where('entreprise_id', $entrepriseId);
        $this->db->where('admin', 0);
        $query = $this->db->get()->custom_result_object('Utilisateur');
        return $query;
    }
}
