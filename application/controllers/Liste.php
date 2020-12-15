<?php
declare(strict_types = 1);
defined('BASEPATH') OR exit('No direct script access allowed');



/**
 * Liste
 * Affiche la page du listing client
 */
class Liste extends MY_Controller {

    
    /**
     * __construct
     *  Défini le css, js et le layout 
     * @return void
     */
    public function __construct(){
        parent::__construct();
        $this->layout->set_theme("back-office");
    }
    
    /**
     * index
     *  Affiche la page du listing client
     * @return void
     */
    public function index(array $clients = NULL, array $contacts = NULL) :void{
        $data['clients'] = $clients;
        $data['contacts'] = $contacts;

        $this->layout->set_title("GoodManager | Liste clients");
        $this->layout->set_page("Liste Clients");
        $this->layout->view('liste', $data);
        
    }
    
    /**
     * search
     *  récupère la liste des clients en fonction des recherches
     * @return void
     */
    public function search() :void{
        if($this->form_validation->run()){
            $contacts =[];
            $field = $this->input->post('select-search');
            $value = $this->input->post('search');

            $clients = $this->Client_model->getClientBy($field, $value);
            
            $contacts = $this->Contact_model->getContact();
            $this->index($clients, $contacts);

        }else{
            redirect("liste-clients");
        }
    }
    
    /**
     * contact
     *  Enregistre ou efface le contact d'un client du jour et renvoie du JSON
     * @return void
     */
    public function contact() :void{

        $input_data = $this->getInput();
        $response = [];
        $response['status'] = '';


        $data['client_id']= $input_data['id'];
        $data['utilisateur_id'] = $this->session->session_id;
        $data['date'] = date('Y-m-d');

        if($this->input->method() == 'post'){

            $response['status'] = 'contact_added';
            $this->Contact_model->insert($data);

        }elseif($this->input->method() == 'delete'){

            $response['status'] = 'contact_removed';
            $this->Contact_model->deleteContact($data);

        }else{
            $response['status'] = 'error';
        }
        header('Content-type: application/json');
        echo json_encode($response);

    }
    
    /**
     * historyContact
     *  Renvoi en JSON l'ensemble de l'historique des contacts d'un client
     * @param  mixed $client_id
     * @return void
     */
    public function historyContact(int $client_id) :void{
        $history = $this->Contact_model->getHistoryContact($client_id);
        header('Content-type: application/json');
        echo json_encode($history);
    }
}