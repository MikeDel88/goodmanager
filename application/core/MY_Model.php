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
     * @return bool
     */
    public function insert(array $fields = []) :bool{
        return $this->db->set($fields)->insert($this->getTable());
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
     * selectAll
     *
     * @param  array $data
     * @return void
     */
    public function selectAll(array $data){
        $this->db->select('*');
        $this->db->from($this->getTable());
        $this->db->like($data, 'before');
        $this->db->order_by('last_name', 'ASC');
        return $this->db->get()->result();
    }
        
    /**
     * update
     *
     * @param  array $data
     * @param  int $id
     * @return bool
     */
    public function update(array $data, int $id) :bool{
        $query = $this->db->set($data)
        ->set('updated_at', date('Y-m-d H:i:s'))
        ->where('id', $id)
        ->update($this->getTable());
        return $query;
    }
    
    /**
     * delete
     *
     * @param  int $id
     * @return void
     */
    public function delete(string $field, int $id) :void{
        $this->db->where($field, $id);
        $this->db->delete($this->getTable());
    }
}