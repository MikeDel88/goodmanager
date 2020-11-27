<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Connexion extends MY_Controller {


    public function __construct(){
		parent::__construct();
    }

    // Affiche la page de connexion
    public function index(){
        $data = [];
        if ($this->form_validation->run())
        {
            $email = html_escape($this->input->post('email'));
            $password = html_escape($this->input->post('password'));
            $result = $this->Users_model->select('email', $email);
            $verif = password_verify($password, $result->password);

            if($verif && !empty($result) && $result->activate == 1){
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

}