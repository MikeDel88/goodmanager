<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Entreprise_model extends MY_Model {

    public string $table;

    public function __construct(){
        parent::__construct();
        $this->table = 'entreprise';
    }

    public function register($data){
        $this->insert($data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

}