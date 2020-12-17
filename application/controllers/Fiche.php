<?php
declare(strict_types = 1);
defined('BASEPATH') or exit('No direct script access allowed');



/**
 * Gestion
 * Affiche la page gestion client, permet de créer, afficher, modifier et supprimer un client après une recherche
 */
class Fiche extends MY_Controller
{


    /**
     * __construct
     *  Défini le css, js et le layout
     * @return void
     */
    public function __construct()
    {
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
    public function index(?int $id, ?string $nom) :void
    {
        $data = [];
        $data['client'] = $this->Client_model->select('id', $id, 'Client');
        $this->layout->set_title("GoodManager | Fiche Client");
        $this->layout->set_page("Fiche Client | " . ucFirst($data['client']->nom));
        $this->layout->view('fiche', $data);
    }
    
    /**
     * update
     *  Met à jour la fiche client
     * @return void
     */
    public function update() :void
    {
        $data = $this->post();
        $id = intval($data['id']);

        if ($this->form_validation->run()) {
            if (isset($data['adresse']) && isset($data['code_postal']) && isset($data['ville'])) {
                $coordonnees = $this->coordonnees($data['adresse'], $data['code_postal'], $data['ville']);
                $data['lat'] = $coordonnees['lat'];
                $data['lng'] = $coordonnees['lng'];
            }
            $this->Client_model->update($data, $id);
            redirect("fiche-client/$id/{$data['nom']}");
        }
        redirect("fiche-client/$id/{$data['nom']}");
    }
    
    /**
     * delete
     * Supprime un client
     * @return void
     */
    public function delete() :void
    {
        if ($this->form_validation->run()) {
            $id = intval($this->input->post('id'));
            $this->Contact_model->delete('client_id', $id);
            $this->RendezVous_model->delete('client_id', $id);
            $this->Client_model->delete('id', $id);
            redirect('gestion-clients');
        }
    }
}
