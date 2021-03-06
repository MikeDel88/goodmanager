<?php
declare(strict_types = 1);
defined('BASEPATH') or exit('No direct script access allowed');



/**
 * Gestion
 * Affiche la page gestion client, permet de créer, afficher, modifier et supprimer un client après une recherche
 */
class Gestion extends MY_Controller
{


    /**
     * __construct
     *  Défini le css, js et le layout
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->layout->set_js(base_url('assets/js/gestion.js'));
        $this->layout->set_theme("back-office");
    }

    
    /**
     * index
     *  Affiche la page de gestion client, permet la recherche et l'ajout d'un client
     * @return void
     */
    public function index(?string $msg = null) :void
    {
        $data = [];
        $data['msg'] = $msg;
        $data['user'] = $this->getUtilisateur();
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
    public function add() :void
    {
        if ($this->form_validation->run()) {
            $data = $this->post();
   

            if (isset($data['adresse']) && isset($data['code_postal']) && isset($data['ville'])) {
                $coordonnees = $this->coordonnees($data['adresse'], $data['code_postal'], $data['ville']);
                $data['lat'] = $coordonnees['lat'];
                $data['lng'] = $coordonnees['lng'];
            }

            $result = $this->Client_model->insert($data);
            $msg = ($result == true) ? "success" : "error";
            redirect("gestion-clients/$msg");
        }
        redirect('gestion-clients');
    }
    
    /**
     * api
     *  Récupère le nom d'un client et renvoi du JSON pour un traiment en AJAX
     * @param  string $search
     * @return void
     */
    public function api(string $search) :void
    {
        $data = [];
        $data['entreprise_id'] = $this->session->entreprise_id;
        
        if ($search !== 'all') {
            $data['nom'] = urldecode($search);
        }

        $result = $this->Client_model->selectAll($data);
        header('Content-type: application/json');
        echo json_encode($result);
    }
}
