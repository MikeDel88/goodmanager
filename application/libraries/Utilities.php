<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilities {

    public function __get($attr){    
        $method = 'get'.ucFirst($attr);        
        return $this->$method();   
    }
    public function __set($attr, $value){  
        $method = 'set'.ucFirst($attr);
        $this->$method($value);
    }
    
}
