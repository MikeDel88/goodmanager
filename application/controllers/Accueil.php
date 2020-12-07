<?php
declare(strict_types = 1);
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Accueil
 * Permet d'afficher la page d'accueil
 */
class Accueil extends CI_Controller {

    public function __construct(){
      parent::__construct();
      $base = base_url();
      $this->layout->set_css("$base/assets/css/layout1.css");
      $this->layout->set_js($base . "assets/js/layout1.js");
      $this->layout->set_theme('front-office');
    }
 
    /**
     * index
     *
     * @return void affiche la page d'accueil
     */
    public function index() :void{
     
        $this->layout->set_title("GoodManager | Accueil");
        $this->layout->view("accueil");

    }
}
