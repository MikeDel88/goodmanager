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
    
    /**
     * index
     *  Affiche la page de géolocalisation
     * @return void
     */
    public function index(){
        $this->layout->set_title("GoodManager | Geolocalisation");
        $this->layout->set_page("Géolocalisation des clients");
        $this->layout->view('geolocalisation');
    }
    
    /**
     * geolocalisationClient
     *  Renvoi en JSON la liste des clients dans un périmètre 
     * @param  mixed $lat
     * @param  mixed $lng
     * @param  mixed $distance
     * @return void
     */
    public function geolocalisationClient($lat, $lng, $distance) :void{

        $result = $this->Client_model->getGeolocalisationClients($lat, $lng,$distance);
        
        header('Content-type: application/json');
        echo json_encode($result);
        
    }
}