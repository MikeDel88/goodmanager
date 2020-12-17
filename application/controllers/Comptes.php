<?php
declare(strict_types = 1);
defined('BASEPATH') or exit('No direct script access allowed');



/**
 * Comptes
 * Affiche la page de la gestion des comptes collaborateurs de l'entreprise vu par l'admin
 */
class Comptes extends MY_Controller
{


    /**
     * __construct
     *  Défini le css, js et le layout
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        if ($this->session->admin == false) {
            redirect('/connexion');
        }
        $this->layout->set_theme("back-office");
    }

    
    /**
     * index
     *  Affiche la page de gestion des comptes
     * @return void
     */
    public function index() :void
    {
        $data = [];
        $data['utilisateur'] = $this->Utilisateur_model->getUtilisateur($this->session->entreprise_id);

        $this->layout->set_title("GoodManager | Gestion Comptes");
        $this->layout->set_page("Gestion Comptes collaborateurs");
        $this->layout->view('comptes', $data);
    }
    
    /**
     * passgen2
     *
     * @param  mixed $nbChar
     * Retourne un mot de passe provisoire au collaborateur enregistré par l'admin
     * @return string
     */
    private function passgen2($nbChar) :string
    {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 1, $nbChar);
    }
    
    /**
     * add
     *  Ajout d'un nouveau collaborateur, envoi d'email avec mot de passe provisoire et token de validation
     * @return void
     */
    public function add() :void
    {
        if ($this->form_validation->run()) {
            $data = $this->post();
            $string_token = strval(microtime(true)*100000);
            $token = md5($string_token);
            $mdp = $this->passgen2(10);
            $token_validation = date('Y-m-d H:i:s', strtotime('+1 day', strtotime(date("Y-m-d H:i:s"))));
            $email = $data['email'];

            $data['entreprise_id'] = $this->session->entreprise_id;
            $data['active'] = 0;
            $data['admin'] = 0;
            $data['token'] = $token;
            $data['token_validation'] = $token_validation;
            $data['mdp'] = password_hash($mdp, PASSWORD_DEFAULT);

            $this->Utilisateur_model->insert($data);

            $lien = BASE_URL . "validation/" . $token;
            $this->email->from(SMTP_USER, 'No-Reply');
            $this->email->to($email);
            $this->email->subject('Validation GoodManager');
            $this->email->message("
                <p>L'administrateur de l'entreprise vous a rajouté comme collaborateur.<br>Merci de cliquer sur le lien ci-dessous pour activer le compte.</p>
                <p>Mot de passe provisoire : $mdp</p>
                <a href='$lien' target='_blank'>Lien de confirmation valable jusqu'au $token_validation</a>
            ");
            $this->email->send();
        }
        redirect('gestion-comptes');
    }
    
    /**
     * delete
     *  Supprime un collaborateur par l'admin
     * @return void
     */
    public function delete() :void
    {
        $userId = intval($this->input->post('id'));
        $this->Contact_model->delete('utilisateur_id', $userId);
        $this->RendezVous_model->delete('utilisateur_id', $userId);
        $this->Utilisateur_model->delete('id', $userId);
        redirect('/gestion-comptes');
    }
}
