<?php
declare(strict_types = 1);
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * Inscription
 * Permet l'inscription de l'utilisateur et de son entreprise avec un mail de validation
 */
class Inscription extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->layout->set_css(base_url("assets/css/inscription.css"));
        $this->layout->set_theme('front-office');

    }
    
    /**
     * index
     *
     * @return void Affiche la page d'inscription
     */
    public function index() :void
    {
        $data = [];
        if ($this->form_validation->run()) {

            $entreprise_id = $this->registerEntreprise();

            if($entreprise_id !== 0){
                $register = $this->register($entreprise_id);
                
                if($register == true){
                    $data['confirm'] = 1;
                }else{
                    $data['not_confirm'] = 0;
                }
                
            }else{
                $data['not_confirm'] = 0;
            }
            
        }

        $this->layout->set_title("GoodManager | Inscription");
        $this->layout->view("inscription", $data);
    }
 
    /**
     * registerEntreprise
     *
     * @return int Enregistrement de l'entreprise avec son nom et on retourne l'id
     */
    private function registerEntreprise(): int
    {
        $data = [];
        $data['nom'] = strtolower($this->input->post("entreprise"));
        return $this->Entreprise_model->register($this->security->xss_clean($data));
    }

    /**
     * register
     *
     * @param  mixed $entreprise_id
     * @return bool Enregistrement de l'utilisateur, envoi d'email et création d'un token de validité valable 24 heures.
     */
    private function register(int $entreprise_id): bool
    {
        $string_token = strval(microtime(true)*100000);
        $token = md5($string_token);
        $token_validation = date('Y-m-d H:i:s', strtotime('+1 day', strtotime(date("Y-m-d H:i:s"))));
        $mdp_hash = password_hash($this->input->post('mdp_repeat'), PASSWORD_DEFAULT);
        $email = $this->input->post('email');

        $data = array(
            'email' => $email,
            'token' => $token,
            'entreprise_id' => $entreprise_id,
            'token_validation' => $token_validation,
            'mdp' => $mdp_hash,
            'active' => '0',
            'admin' => true,
            );

        // Enregistrement de l'utilisateur
        $register_user = $this->Utilisateur_model->insert($this->security->xss_clean($data));

        if($register_user == false){

            return false;

        }else{ 
            $lien = BASE_URL . "validation/" . $token;
            $this->email->from(SMTP_USER, 'No-Reply');
            $this->email->to($email);
            $this->email->subject('Validation GoodManager');
            $this->email->message("
            <p>Bienvenue sur le site de GoodManager ! <br>Afin de valider votre inscription, il vous faut cliquer sur le lien ci-dessous</p>
            <a href='$lien' target='_blank'>Lien de confirmation valable jusqu'au $token_validation</a>
            ");
            $this->email->send();
            
            return ($this->email->send(false)) ? false : true;
        }

        
    }
   
    /**
     * validation
     *
     * @param  mixed $token
     * @return void Récupère le lien avec le token et vérifie pour activer le compte
     */
    public function validation(string $token):void
    {
        $verification = $this->Utilisateur_model->selectToken($token);
        $date_time = date("Y-m-d H:i:s");

        if ($token === $verification->token && $date_time <= $verification->token_validation) {
            $this->Utilisateur_model->activation($verification->id);
            redirect('connexion');
        }
        redirect("/");
    }
}
