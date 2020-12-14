<?php
declare(strict_types = 1);
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Errors
 * Permet d'afficher la page d'Errors
 */
class Errors extends CI_Controller {

    public function __construct(){
      parent::__construct();
      $base = base_url();
      $this->layout->set_theme('front-office');
    }
 
    /**
     * index
     *
     * @return void affiche la page d'erreur 404
     */
    public function error404() :void{
     
        $this->layout->set_title("GoodManager | Page introuvable");
        $this->layout->view("error");

    }
}