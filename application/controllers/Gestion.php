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
        $this->layout->set_theme("back-office");
    }

    
    /**
     * index
     *  Affiche la page de gestion client, permet la recherche et l'ajout d'un client
     * @return void
     */
    public function index() :void{

        $data['user'] = $this->getUser();
        $data['entreprise'] = $this->getEntreprise($this->session->entreprise_id);

        $this->layout->set_title("GoodManager | Gestion Clients");
        $this->layout->set_page("Gestion Clients");
        $this->layout->view('gestion', $data);

    }
    
    /**
     * add
     *  Validation du formulaire d'ajout d'un client 
     * @return void
     */
    public function add() :void{
        if ($this->form_validation->run()){

            $data = $this->post();
   

            if(isset($data['address']) && isset($data['zipcode']) && isset($data['city'])){
                $coordonnees = $this->coordonnees($data['address'], $data['zipcode'], $data['city']);
                $data['lat'] = $coordonnees['lat'];
                $data['lng'] = $coordonnees['lng'];
            }

            $this->Client_model->insert($data);
            redirect('gestion-clients');

        }else{
            redirect('gestion-clients');
        }
    }
    
    /**
     * api
     *  Récupère le nom d'un client et renvoi du JSON pour un traiment en AJAX
     * @param  string $search
     * @return void
     */
    public function api(string $search) :void{
        if($search == 'all'){
            $data = [
                'entreprise_id' => $this->session->entreprise_id,
            ];
        }else{
            $data = [
                'entreprise_id' => $this->session->entreprise_id,
                'last_name' => urldecode($search)
            ];
        }

        $result = $this->Client_model->selectAll($data);
        header('Content-type: application/json');
        echo json_encode($result);
    }

}
