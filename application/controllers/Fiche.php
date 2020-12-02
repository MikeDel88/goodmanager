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
    
    /**
     * index
     *  Affiche la fiche d'un client
     * @param  int $id
     * @param  string $nom
     * @return void
     */
    public function index(?int $id, ?string $nom) :void{

        $data['client'] = $this->Client_model->select('id', $id, 'Client');

        $this->layout->set_title("GoodManager | Fiche Client");
        $this->layout->set_page("Fiche Client | " . ucFirst($data['client']->last_name));
        $this->layout->view('fiche', $data);

    }
    
    /**
     * update
     *  Met à jour la fiche client
     * @return void
     */
    public function update() :void{
        if ($this->form_validation->run()){

            $data = $this->post();
            $id = intval($data['id']);
            $this->Client_model->update($data, $id);
            redirect("fiche-client/$id/{$data['last_name']}");

        }else{
            redirect('gestion-clients');
        }
    }
}