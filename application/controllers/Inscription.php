<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Inscription extends MY_Controller {


    public function __construct(){
		parent::__construct();
    }
    
    // Affiche la page d'inscription
    public function index(){
        $data = [];
        if ($this->form_validation->run())
        {
            $entreprise_id = $this->registerEntreprise();
            $data['confirm'] = $this->register($entreprise_id);
        }

        $this->layout->set_title("GoodManager | Inscription");
        $this->layout
                    ->views('partials/header.inc.php')
                    ->views("inscription", $data)
                    ->view('partials/footer.inc.php');
    }

     // Enregistrement de l'entreprise avec son nom et on retourne l'id
    private function registerEntreprise(){

       
        $data['name'] = html_escape($this->input->post("entreprise"));
        return $this->Entreprise_model->register($data);

    }

    // Enregistrement de l'utilisateur, envoi d'email et création d'un token de validité valable 24 heures. 
    private function register($entreprise_id){

            $token = md5(microtime(TRUE)*100000);
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

    // Récupère le lien avec le token et vérifie pour activer le compte
    public function validation($token){

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