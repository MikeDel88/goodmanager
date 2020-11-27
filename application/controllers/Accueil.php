<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Accueil extends MY_Controller {

    public function __construct(){
		parent::__construct();
    }

     // Affiche la page d'inscription
    public function index(){
     
        $this->layout->set_title("GoodManager | Accueil");
        $this->layout
                    ->views('partials/header.inc.php')
                    ->views("accueil")
                    ->view('partials/footer.inc.php');
    }
}
