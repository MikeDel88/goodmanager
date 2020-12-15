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
    
    /**
     * index
     * Affichage de la page rendez-vous
     * @return void
     */
    public function index() :void{
        $this->layout->set_title("GoodManager | Rendez-vous");
        $this->layout->set_page("Calendrier des rendez-vous");
        $this->layout->view('rendez-vous');
    }
    
    /**
     * add
     * Ajouter un rendez-vous depuis la liste des clients en JSON
     * @return void
     */
    public function add() :void{

        $input_data = $this->getInput();
        $response = [];
        

        $data['client_id']= $input_data['id'];
        $data['utilisateur_id'] = $this->session->session_id;
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
    public function getAll() :void{
        $result = $this->RendezVous_model->selectAllRdv();
        echo json_encode($result);
    }
    
    /**
     * delete
     * Supprimer un rendez-vous, renvoi une réponse en JSON
     * @return void
     */
    public function delete() :void{
        $input_data = $this->getInput();
        $response = [];

        $this->RendezVous_model->deleteRDV(intval($input_data['id']));

        $response['status'] = 'delete_rdv';
        
        echo json_encode($response);
    }
    
    /**
     * modification
     * Permet de modifier un rendez-vous, renvoi une réponse en JSON
     * @return void
     */
    public function modification() :void{
        $input_data = $this->getInput();
        $response = [];
        
        $data['date'] = $input_data['dateRDV'];
        $id = intval($input_data['id']);

        $this->RendezVous_model->updateRDV($data, $id);
        $response['status'] = 'modification_ok';
        echo json_encode($response);
    }
}