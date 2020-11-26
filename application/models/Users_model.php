<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Users_model extends MY_Model {

    public string $table;

    public function __construct(){
        parent::__construct();
        $this->table = 'users';
    }

    public function selectToken($token){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('token', $token);
        return $this->db->get()->row();
    }

    public function activation($id){
        $this->db->set('activate', 1);
        $this->db->where('id', $id);
        $this->db->update($this->table);
    }


}