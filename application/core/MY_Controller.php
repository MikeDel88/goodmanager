<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * MY_Controller
 * Controller général qui permet de vérifier si une session est ouverte
 */
class MY_Controller extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if($this->session->session_logged !== true){
            //faire une page "inaccessible avec un lien vers l'inscription"
            redirect('inscription');
        }
    }

    protected function getUser(){
        return $this->Users_model->select('id', $this->session->session_id, 'User');
    }

    protected function getEntreprise($id){
        return $this->Entreprise_model->select('id', $id, 'Entreprise');
    }

    protected function post(){
        $posts = $this->input->post();
        foreach($posts as $post => $value){
            $data[$post] = $value;
        }
        return $data;
    }
}