<?php
declare(strict_types = 1);
defined('BASEPATH') OR exit('No direct script access allowed');



/**
 * Gestion
 * Affiche la page gestion client, permet de créer, afficher, modifier et supprimer un client après une recherche
 */
class Gestion extends MY_Controller {


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


    public function index(){

        $data['user'] = $this->getUser();
        $data['entreprise'] = $this->getEntreprise($this->session->entreprise_id);

        $this->layout->set_title("GoodManager | Gestion Clients");
        $this->layout->set_page("Gestion Clients");
        $this->layout->view('gestion', $data);

    }

    public function add(){
        if ($this->form_validation->run()){

            $data = $this->post();
            $this->Client_model->insert($data);
            redirect('gestion-clients');

        }else{
            redirect('gestion-clients');
        }
    }

    public function api($search){
        $data = [
            'entreprise_id' => $this->session->entreprise_id,
            'last_name' => urldecode(html_escape($search))
        ];
        $result = $this->Client_model->selectAll($data);
        header('Content-type: application/json');
        echo json_encode($result);
    }

}
