<?php
defined('BASEPATH') OR exit('No direct script access allowed');



/**
 * Profile
 * Affiche la page du profil de l'utilisateur et permet les modifications et la suppression du compte
 */
class Profile extends MY_Controller {


    public function __construct(){
        parent::__construct();
        $this->layout->set_css(base_url() . "assets/css/layout2.css");
        $this->layout->set_js(base_url() . "assets/js/layout2.js");
        $this->layout->set_theme("back-office");
    }

    public function index(){

        $data['user'] = $this->getUser();
        $data['entreprise'] = $this->getEntreprise($this->session->entreprise_id);

        $this->layout->set_title("GoodManager | Espace Personnel");
        $this->layout->set_page("Mon Profil");
        $this->layout->view('profile', $data);

    }

    public function miseAJourEntreprise(){
        if($this->form_validation->run())
        {
            $data = $this->post();
            $this->Entreprise_model->update($data, $this->session->entreprise_id);
            redirect("/espace-personnel");
        }
    }

    public function miseAJourUser(){
        if($this->form_validation->run())
        {
            $data = $this->post();
            $this->Users_model->update($data, $this->session->session_id);
            redirect("/espace-personnel");
        }
    }

    public function deleteUser(){
        $this->Users_model->delete($this->session->session_id);
        $this->Entreprise_model->delete($this->session->entreprise_id);
        redirect('/');
    }


}