<?php
defined('BASEPATH') OR exit('No direct script access allowed');



/**
 * Profile
 * Affiche la page du profil de l'utilisateur et permet les modifications et la suppression du compte
 */
class Profile extends MY_Controller {


    public function __construct(){
        parent::__construct();
        $base = base_url();
        $this->layout->set_css($base . "assets/css/layout2.css");
        $this->layout->set_js($base . "assets/js/layout2.js");

    }

    public function index(){
        echo "<pre>";
        print_r($this->getUser());
        echo "</pre>";
    }

    private function getUser(){
        return $this->Users_model->select('id', $this->session->session_id, 'User');
    }

}