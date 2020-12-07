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
        $this->layout->set_css(base_url() . "assets/fullcalendar/lib/main.css");
        $this->layout->set_js(base_url() . "assets/fullcalendar/lib/main.js");
        $this->layout->set_theme("back-office");
    }

    public function index(){
        $this->layout->set_title("GoodManager | Rendez-vous");
        $this->layout->set_page("Calendrier des rendez-vous");
        $this->layout->view('rendez-vous');
    }
    
    /**
     * add
     * Ajouter un rendez-vous depuis la liste des clients en AJAX
     * @return void
     */
    public function add(){

        $input_data = $this->getInput();
        $response = [];
        

        $data['client_id']= $input_data['id'];
        $data['user_id'] = $this->session->session_id;
        $data['date'] = $input_data['dateRDV'];

        $this->RendezVous_model->insert($data);
        $response['status'] = 'add_rdv';

        echo json_encode($response);
    }

    
    /**
     * getAll
     *  Renvoie la liste des rendez-vous de l'utilisateur de session sous format JSON
     * @return void
     */
    public function getAll(){
        $result = $this->RendezVous_model->selectAllRdv();
        echo json_encode($result);
    }

    public function delete(){
        $input_data = $this->getInput();
        $response = [];

        $this->RendezVous_model->deleteRDV(intval($input_data['id']));

        $response['status'] = 'delete_rdv';
        
        echo json_encode($response);

    }
}