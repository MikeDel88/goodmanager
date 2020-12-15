<?php
declare(strict_types = 1);
defined('BASEPATH') OR exit('No direct script access allowed');



/**
 * Profile
 * Affiche la page du profil de l'utilisateur et permet les modifications et la suppression du compte
 */
class Profile extends MY_Controller {

    
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
     *
     * @return void Affiche la page de profil de l'utilisateur
     */
    public function index(?string $msg = null) :void{
        $data['msg'] = $msg;
        $data['user'] = $this->getUtilisateur();
        $data['entreprise'] = $this->getEntreprise($this->session->entreprise_id);
        $this->layout->set_title("GoodManager | Espace Personnel");
        $this->layout->set_page("Mon Profil");
        $this->layout->view('profile', $data);

    }
    
    /**
     * miseAJourEntreprise
     *
     * @return void Met à jour l'entreprise et redirige vers la page profil
     */
    public function miseAJourEntreprise() :void{
        if($this->form_validation->run())
        {
            $data = $this->post();
            $result = $this->Entreprise_model->update($data, $this->session->entreprise_id);

            // Duplication du nom de l'entreprise, renvoi une erreur
            if($result == false){
                $msg = "error";
                redirect("/espace-personnel/$msg");
            }
        

        }          
        redirect("/espace-personnel");
    }
    
    /**
     * miseAJourUtilisateur
     *
     * @return void Met à jour l'utlisateur et redirige vers la page profil
     */
    public function miseAJourUtilisateur() :void{
        if($this->form_validation->run())
        {
            $data = $this->post();

            $this->Utilisateur_model->update($data, $this->session->session_id);
            
        }
        redirect("/espace-personnel");
    }
    
    /**
     * deleteUtilisateur
     * Suppression d'un utilisateur et si admin, de son entreprise
     * @return void
     */
    public function deleteUtilisateur() :void{

        $this->Contact_model->delete('utilisateur_id', $this->session->session_id);
        $this->RendezVous_model->delete('utilisateur_id', $this->session->session_id);

        if($this->session->admin == true){
            $this->Utilisateur_model->delete('entreprise_id', $this->session->entreprise_id);
            $this->Client_model->delete('entreprise_id', $this->session->entreprise_id);
            $this->Entreprise_model->delete('id', $this->session->entreprise_id);
        }

        $this->Utilisateur_model->delete('id', $this->session->session_id);
        redirect('/');
    }
    
    /**
     * deconnexion
     *  Supprime la session et renvoi sur la page d'accueil
     * @return void
     */
    public function deconnexion() :void{
        $this->session->sess_destroy();
        redirect("connexion");
    }


}