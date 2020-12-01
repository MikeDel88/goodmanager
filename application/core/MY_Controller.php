<?php
declare(strict_types = 1);
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
    
    /**
     * getUser
     *  
     * @return object Récupère un utilisateur
     */
    protected function getUser() :object{
        return $this->Users_model->select('id', $this->session->session_id, 'User');
    }
    
    
    /**
     * getEntreprise
     *
     * @param  int $id
     * @return object Récupère une entreprise
     */
    protected function getEntreprise($id) :object{
        return $this->Entreprise_model->select('id', $id, 'Entreprise');
    }

        
    /**
     * post
     *  Retourne le tableau des posts du formulaire
     * @return array
     */
    protected function post() :array{
        $posts = $this->input->post();
        foreach($posts as $post => $value){
            $data[$post] = html_escape($value);
        }
        return $data;
    }
}