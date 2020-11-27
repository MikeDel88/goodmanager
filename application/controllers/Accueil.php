<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Accueil
 * Permet d'afficher la page d'accueil
 */
class Accueil extends MY_Controller {

    public function __construct(){
		parent::__construct();
    }
 
    /**
     * index
     *
     * @return void affiche la page d'accueil
     */
    public function index() :void{
     
        $this->layout->set_title("GoodManager | Accueil");
        $this->layout
                    ->views('partials/header.inc.php')
                    ->views("accueil")
                    ->view('partials/footer.inc.php');
    }
}
