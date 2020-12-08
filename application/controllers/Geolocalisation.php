<?php
declare(strict_types = 1);
defined('BASEPATH') OR exit('No direct script access allowed');



/**
 * Geolocalisation
 * Affiche la page de la Geolocalisation
 */
class Geolocalisation extends MY_Controller {

    
    /**
     * __construct
     *  Défini le css, js et le layout 
     * @return void
     */
    public function __construct(){
        parent::__construct();
        $this->layout->set_js(base_url() . "assets/js/geolocalisation.js");
        $this->layout->set_theme("back-office");
    }

    public function index(){
        $this->layout->set_title("GoodManager | Geolocalisation");
        $this->layout->set_page("Géolocalisation des clients");
        $this->layout->view('geolocalisation');
    }

    public function geolocalisationClient(){
        
    }
}