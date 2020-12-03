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
        $this->layout->set_css(base_url() . "assets/css/layout2.css");
        $this->layout->set_js(base_url() . "assets/js/layout2.js");
        $this->layout->set_theme("back-office");
    }
    
    /**
     * index
     *  Affiche la page du listing client
     * @return void
     */
    public function index(array $clients = NULL) :void{
        $data['clients'] = $clients;
        $this->layout->set_title("GoodManager | Liste clients");
        $this->layout->set_page("Liste Clients");
        $this->layout->view('liste', $data);
        
    }
    
    /**
     * search
     *  récupère la liste des clients en fonction des recherches
     * @return void
     */
    public function search(){
        if($this->form_validation->run()){
            $field = $this->input->post('select-search');
            $value = $this->input->post('search');
            $clients = $this->Client_model->getClientBy(html_escape($field), html_escape($value));
            $this->index($clients);
        }else{
            redirect("liste-clients");
        }
    }

    public function contact(){

        $input_data = $this->getInput();
        $response = [];
        $response['status'] = '';


        $data['client_id']= $input_data['id'];
        $data['user_id'] = $this->session->session_id;
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

        echo json_encode($response);

    }
}