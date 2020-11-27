<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * MY_Model
 * Permet d'inclure des méthodes génériques en SQL
 */
class MY_Model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function insert($fields = []){
        return $this->db->set($fields)->insert($this->table);
    }

    public function select($fields, $data){
        return $this->db->select('*')->from($this->table)->where($fields, $data)->get()->row();
    }
}