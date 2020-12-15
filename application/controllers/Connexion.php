<?php
declare(strict_types = 1);
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Connexion
 * Permet la connexion de l'utilisateur une fois que son inscription a été validé
 */
class Connexion extends CI_Controller {


    public function __construct(){
        parent::__construct();
        $base = base_url();
        $this->layout->set_css($base . "assets/css/connexion.css");
        $this->layout->set_theme('front-office');
    }
   
    /**
     * index
     *  
     * @return void Affiche la page de connexion et permet de se connecter 
     */
    public function index() :void{
        $data = [];
        if ($this->form_validation->run())
        {
            $email = $this->input->post('email');
            $mdp = $this->input->post('mdp');
            $result = $this->Utilisateur_model->select('email', $email, 'Utilisateur');

            if(!empty($result)){

                $verif = password_verify($mdp, $result->mdp);

                if($verif && $result->active == 1){
                    
                    $this->session->session_id = $result->id;
                    $this->session->entreprise_id = $result->entreprise_id;
                    $this->session->session_logged = true;
                    $this->session->admin = $result->admin;

                    redirect('espace-personnel');

                }else{
                    $data['msg'] = 'Erreur de connexion, merci de réessayer';
                }
            }else{
                $data['msg'] = 'Erreur de connexion, merci de réessayer';
            }
        }

        $this->layout->set_title("GoodManager | Connexion");

        $this->layout->view("connexion", $data);
                    
                    
                    
    }

      
    /**
     * reset
     *
     * @return void Vérification de l'e-mail et envoi d'un lien pour réinitialiser le mot de passe 
     */
    public function reset() :void{
        if ($this->form_validation->run())
        {
            $email = $this->input->post('email');
            $result = $this->Utilisateur_model->select('email', $email, 'Utilisateur');
  
            if(!empty($result) && $result->active == 1){

                $string_token = strval(microtime(TRUE)*100000);
                $token = md5($string_token);
                $token_validation = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime(date("Y-m-d H:i:s"))));

                $data = array(
                    'token' => $token,
                    'token_validation' => $token_validation,
                    'updated_at' => date('Y-m-d H:i:s')
                );

                $this->Utilisateur_model->reset($email, $data); 
                
                $lien = BASE_URL . "reset/" . $token;
                $this->email->from(SMTP_USER, 'No-Reply');
		        $this->email->to($email);
		        $this->email->subject('Modification du mot de passe GoodManager');
                $this->email->message("
                <p>Vous avez souhaité réinitiliser votre mot de passe.<br>Pour faire cela, il vous faut cliquer sur le lien ci-dessous.</p>
                <a href='$lien' target='_blank'>Modification du mot de passe valable jusqu'au $token_validation</a>
                ");
                $this->email->send();
            
                redirect('connexion');
                
            }else{
                redirect('inscription');
            }
        }
    }
      
    /**
     * modification
     *
     * @param  mixed $token
     * @return void Page qui récupère le lien de reset et modifie le mot de passe 
     */
    public function modification(string $token) :void{

        $result = $this->Utilisateur_model->selectToken(html_escape($token));
        $date_time = date("Y-m-d H:i:s");

        if(!empty($result) && $result->token_validation > $date_time){

            $data['token'] = $token;
            
            if ($this->form_validation->run()){
                $data['mdp'] = password_hash(html_escape($this->input->post('mdp_repeat')), PASSWORD_DEFAULT);
                $this->Utilisateur_model->reset($result->email, $data);
                redirect('connexion');
            }

            $this->layout->set_title("GoodManager | Modification du mot de passe");
            $this->layout->view("reset", $data);
 

        }else{
            redirect('inscription');
        }
    }

}