<?php
declare(strict_types = 1);
defined('BASEPATH') OR exit('No direct script access allowed');



/**
 * Comptes
 * Affiche la page de la gestion des comptes collaborateurs de l'entreprise vu par l'admin
 */
class Comptes extends MY_Controller {


    /**
     * __construct
     *  Défini le css, js et le layout 
     * @return void
     */
    public function __construct(){
        parent::__construct();
        if($this->session->admin == false){
            redirect('/connexion');
        }
        $this->layout->set_theme("back-office");
    }

    
    /**
     * index
     *  Affiche la page de gestion des comptes
     * @return void
     */
    public function index() :void{

        $data['users'] = $this->Users_model->getUsers($this->session->entreprise_id);

        $this->layout->set_title("GoodManager | Gestion Comptes");
        $this->layout->set_page("Gestion Comptes collaborateurs");
        $this->layout->view('comptes', $data);
    }

    private function passgen2($nbChar){
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789'),1, $nbChar); 
    }

    public function add(){

        if($this->form_validation->run()){

            $data = $this->post();
            $string_token = strval(microtime(TRUE)*100000);
            $token = md5($string_token);
            $password = $this->passgen2(10);
            $token_validation = date('Y-m-d H:i:s',strtotime('+1 day',strtotime(date("Y-m-d H:i:s"))));
            $email = $data['email'];

            $data['entreprise_id'] = $this->session->entreprise_id;
            $data['activate'] = 0;
            $data['admin'] = 0;
            $data['token'] = $token;
            $data['token_validation'] = $token_validation;
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);

            $this->Users_model->insert($data);

            $lien = BASE_URL . "validation/" . $token;
            $this->email->from(SMTP_USER, 'No-Reply');
		    $this->email->to($email);
		    $this->email->subject('Validation GoodManager');
            $this->email->message("
                <p>Mot de passe provisoire : $password</p>
                <a href='$lien' target='_blank'>Lien de confirmation valable jusqu'au $token_validation</a>
            ");
            $this->email->send();
                   
        }
        redirect('gestion-comptes');
    }

    public function delete() :void{
        $userId = intval($this->input->post('id'));
        $this->Users_model->delete($userId);
        redirect('/gestion-comptes');
    }
}