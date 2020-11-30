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
    public function select(string $fields, string $data, string $class) :object{
        return $this->db->select('*')->from($this->getTable())->where($fields, $data)->get()->custom_row_object(0, $class);
    }
}