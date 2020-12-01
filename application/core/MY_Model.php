<?php
declare(strict_types = 1);
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * MY_Model
 * Permet d'inclure des méthodes génériques en SQL
 */
class MY_Model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }
    
    /**
     * insert
     *
     * @param  array $fields
     * @return void
     */
    public function insert(array $fields = []) :void{
        $this->db->set($fields)->insert($this->getTable());
    }
    
    
    /**
     * select
     *
     * @param  string $fields
     * @param  string $data
     * @param  string $class
     * @return object
     */
    public function select(string $fields, $data, string $class){
        return $this->db->select('*')->from($this->getTable())->where($fields, $data)->get()->custom_row_object(0, $class);
    }
        
    /**
     * update
     *
     * @param  array $data
     * @param  int $id
     * @return void
     */
    public function update(array $data, int $id) :void{
        $this->db->set($data);
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('id', $id);
        $this->db->update($this->getTable());
    }

    public function delete(int $id){
        $this->db->where('id', $id);
        $this->db->delete($this->getTable());
    }
}