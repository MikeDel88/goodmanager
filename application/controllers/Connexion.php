<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Connexion
 * Permet la connexion de l'utilisateur une fois que son inscription a été validé
 */
class Connexion extends MY_Controller {


    public function __construct(){
		parent::__construct();
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
            $email = html_escape($this->input->post('email'));
            $password = html_escape($this->input->post('password'));
            $result = $this->Users_model->select('email', $email);
            $verif = password_verify($password, $result->password);

            if($verif && !empty($result) && $result->activate == 1){
                // mettre en place les sessions, voir cookies, délai d'inactivité et redirection vers l'espace admin
                redirect('inscription');
            }else{
                $data['msg'] = 'Erreur de connexion, merci de réessayer';
            }
        }

        $this->layout->set_title("GoodManager | Connexion");
        $this->layout
                    ->views('partials/header.inc.php')
                    ->views("connexion", $data)
                    ->view('partials/footer.inc.php');
    }

      
    /**
     * reset
     *
     * @return void Vérification de l'e-mail et envoi d'un lien pour réinitialiser le mot de passe 
     */
    public function reset() :void{
        if ($this->form_validation->run())
        {
            $email = html_escape($this->input->post('email'));
            $result = $this->Users_model->select('email', $email);
  
            if(!empty($result) && $result->activate == 1){

                $token = md5(microtime(TRUE)*100000);
                $token_validation = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime(date("Y-m-d H:i:s"))));

                $data = array(
                    'token' => $token,
                    'token_validation' => $token_validation,
                    'updated_at' => date('Y-m-d H:i:s')
                );

                $this->Users_model->reset($email, $data); 
                
                $lien = BASE_URL . "reset/" . $token;
                $this->email->from(SMTP_USER, 'No-Reply');
		        $this->email->to($email);
		        $this->email->subject('Modification du mot de passe GoodManager');
		        $this->email->message("<a href='$lien' target='_blank'>Modification du mot de passe valable jusqu'au $token_validation</a>");
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

        $result = $this->Users_model->selectToken(html_escape($token));
        $date_time = date("Y-m-d H:i:s");

        if(!empty($result) && $result->token_validation > $date_time){

            $data['token'] = $token;
            
            if ($this->form_validation->run()){
                $data['password'] = password_hash(html_escape($this->input->post('password_repeat')), PASSWORD_DEFAULT);
                $this->Users_model->reset($result->email, $data);
                redirect('connexion');
            }

            $this->layout->set_title("GoodManager | Modification du mot de passe");
            $this->layout
                    ->views('partials/header.inc.php')
                    ->views("reset", $data)
                    ->view('partials/footer.inc.php');

        }else{
            redirect('inscription');
        }
    }

}