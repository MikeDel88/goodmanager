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

            // On vérifie si le nom de l'entreprise ou l'email est déjà présent en BDD
            $inputEntreprise = $this->security->xss_clean($this->input->post("entreprise"));
            $entrepriseExiste = $this->Entreprise_model->check('nom', $inputEntreprise);
            $inputMail = $this->security->xss_clean($this->input->post("email"));
            $emailExiste = $this->Utilisateur_model->check('email', $inputMail);
             
            if($emailExiste === 1 || $entrepriseExiste === 1){
                $data['confirm'] = false;
            }
            else{
                $entreprise_id = $this->registerEntreprise($inputEntreprise);
                $register = $this->register($entreprise_id);
                $data['confirm'] = ($register === true) ? true : false;
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
    private function registerEntreprise($nameEntreprise): int
    {
        $data = [];
        $data['nom'] = strtolower($nameEntreprise);
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
            $emailResult = $this->email($token, $token_validation, $email);
            return ($emailResult && $register_user) ? true : false;
        }

    }
    
    
    /**
     * email
     * Permet l'envoi d'un email à l'utilisateur en cours d'inscription
     * @param  mixed $token
     * @param  mixed $token_validation
     * @param  mixed $email
     * @return bool
     */
    private function email(string $token, string $token_validation, string $email) :bool{

        $lien = BASE_URL . "validation/" . $token;
        $token_validation_fr = date("d-m-Y à H:i:s", strtotime($token_validation));
        $this->email->from(SMTP_USER, 'No-Reply');
        $this->email->to($email);
        $this->email->subject('Validation GoodManager');
        $this->email->message("
        <p>Bienvenue sur le site de GoodManager ! <br>Afin de valider votre inscription, il vous faut cliquer sur le lien ci-dessous</p>
        <a href='$lien' target='_blank'>Lien de confirmation valable jusqu'au $token_validation_fr</a>
        ");

        return ($this->email->send()) ? true : false;

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
