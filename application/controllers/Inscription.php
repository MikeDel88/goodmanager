<?php
declare(strict_types = 1);
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Inscription
 * Permet l'inscription de l'utilisateur et de son entreprise avec un mail de validation
 */
class Inscription extends CI_Controller {


    public function __construct(){
        parent::__construct();
        $base = base_url();
        $this->layout->set_css("$base/assets/css/layout1.css");
        $this->layout->set_js($base . "assets/js/layout1.js");
        $this->layout->set_theme('front-office');
    }
    
    /**
     * index
     *
     * @return void Affiche la page d'inscription   
     */
    public function index() :void{
        $data = [];
        if ($this->form_validation->run())
        {
            $entreprise_id = $this->registerEntreprise();
            $data['confirm'] = $this->register($entreprise_id);
        }

        $this->layout->set_title("GoodManager | Inscription");
        $this->layout->view("inscription", $data);
                    

    }
 
    /**
     * registerEntreprise
     *
     * @return int Enregistrement de l'entreprise avec son nom et on retourne l'id 
     */
    private function registerEntreprise(): int{

       
        $data['name'] = html_escape($this->input->post("entreprise"));
        return $this->Entreprise_model->register($data);

    }

    /**
     * register
     *
     * @param  mixed $entreprise_id
     * @return bool Enregistrement de l'utilisateur, envoi d'email et création d'un token de validité valable 24 heures. 
     */
    private function register(int $entreprise_id): bool {
        
            $string_token = strval(microtime(TRUE)*100000);
            $token = md5($string_token);
            $token_validation = date('Y-m-d H:i:s',strtotime('+1 day',strtotime(date("Y-m-d H:i:s"))));
            $password_hash = password_hash(html_escape($this->input->post('password_repeat')), PASSWORD_DEFAULT);
            $email = html_escape($this->input->post('email'));

            $data = array(
            'email' => $email,
            'token' => $token,
            'entreprise_id' => $entreprise_id,
            'token_validation' => $token_validation,
            'password' => $password_hash,
            'activate' => '0',
            );

            // Enregistrement de l'utilisateur
            $register_user = $this->Users_model->insert($data);

            $lien = BASE_URL . "validation/" . $token;
            $this->email->from(SMTP_USER, 'No-Reply');
		    $this->email->to($email);
		    $this->email->subject('Validation GoodManager');
		    $this->email->message("<a href='$lien' target='_blank'>Lien de confirmation valable jusqu'au $token_validation</a>");
            $this->email->send();
            
		    return ($this->email->send(FALSE)) ? false : true;

    }
   
    /**
     * validation
     *
     * @param  mixed $token
     * @return void Récupère le lien avec le token et vérifie pour activer le compte 
     */
    public function validation($token):void{

        $verification = $this->Users_model->selectToken($token);
        $date_time = date("Y-m-d H:i:s");

        if($token === $verification->token && $date_time <= $verification->token_validation){
            $this->Users_model->activation($verification->id);
            redirect('connexion');
        }else{
            redirect("/");
        }
    }


}