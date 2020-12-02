<?php
declare(strict_types = 1);
defined('BASEPATH') OR exit('No direct script access allowed');



/**
 * Gestion
 * Affiche la page gestion client, permet de créer, afficher, modifier et supprimer un client après une recherche
 */
class Fiche extends MY_Controller {


    /**
     * __construct
     *  Défini le css, js et le layout 
     * @return void
     */
    public function __construct(){
        parent::__construct();
        $this->layout->set_css(base_url() . "assets/css/layout2.css");
        $this->layout->set_js(base_url() . "assets/js/layout2.js");
        $this->layout->set_theme("back-office");
    }

    public function index($id, $nom){

        $data['client'] = $this->Client_model->select('id', $id, 'Client');
        
        $this->layout->set_title("GoodManager | Gestion Clients");
        $this->layout->set_page("Fiche Client | " . ucFirst(urldecode($nom)));
        echo "<pre>";
        print_r($data['client']);
        echo "</pre>";

    }
}