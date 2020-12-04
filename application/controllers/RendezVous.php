<?php
declare(strict_types = 1);
defined('BASEPATH') OR exit('No direct script access allowed');



/**
 * Profile
 * Affiche la page du profil de l'utilisateur et permet les modifications et la suppression du compte
 */
class RendezVous extends MY_Controller {

    
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

    public function add(){

        $input_data = $this->getInput();
        $response = [];
        

        $data['client_id']= $input_data['id'];
        $data['user_id'] = $this->session->session_id;
        $data['entreprise_id'] = $this->session->entreprise_id;
        $data['date'] = $input_data['dateRDV'];

        $this->RendezVous_model->insert($data);
        $response['status'] = 'add_rdv';

        echo json_encode($response);
    }
}