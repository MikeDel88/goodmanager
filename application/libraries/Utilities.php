<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Utilities
 * Permet de récupérer de façon automatique les getters et setters
 */
class Utilities
{
    
    /**
     * __get
     *
     * @param  mixed $attr
     * @return void methode magique getter
     */
    public function __get($attr)
    {
        $method = 'get'.ucFirst($attr);
        return $this->$method();
    }
    /**
     * __set
     *
     * @param  mixed $attr
     * @param  mixed $value
     * @return void méthode magique setter
     */
    public function __set($attr, $value)
    {
        $method = 'set'.ucFirst($attr);
        $this->$method($value);
    }
}
