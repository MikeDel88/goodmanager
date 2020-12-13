<?php
declare(strict_types = 1);
defined('BASEPATH') OR exit('No direct script access allowed');



/**
 * Dashboard
 * Affiche la page de la Dashboard
 */
class Dashboard extends MY_Controller {

    
    /**
     * __construct
     *  Défini le css, js et le layout 
     * @return void
     */
    public function __construct(){
        parent::__construct();
        $this->layout->set_js(base_url() . "assets/js/dashboard.js");
        $this->layout->set_theme("back-office");
    }

    public function index(){
        $this->layout->set_title("GoodManager | Tableau de bord");
        $this->layout->set_page("Les Analyses");
        $this->layout->view('dashboard');
    }

    public function newClients(){
        $result = $this->Client_model->selectNewClientByYear();

        header('Content-type: application/json');
        echo json_encode($result);
    }

    public function NumberClientsByYear(string $datas){
        $results = [];
        $annees = explode("-", $datas);
        foreach($annees as $annee){
            $results[] = [
                'annee' => $annee,
                'nombre' => $this->Client_model->selectNumberClientByYear($annee),
            ];
        }
        header('Content-type: application/json');
        echo json_encode($results);
    }

    public function NumberClientByDept(){
        $result = $this->Client_model->selectNombreClientByDept();

        header('Content-type: application/json');
        echo json_encode($result);
    }

    public function SansTelNiMail(){

        $result = [];

        $sansTel = $this->Client_model->selectSansInfo('phone');
        $sansEmail = $this->Client_model->selectSansInfo('email');
        $sansTelNiMail = $this->Client_model->selectSansTelNiMail('phone', 'email');

        $result[] = $sansTel;
        $result[] = $sansEmail;
        $result[] = $sansTelNiMail;

        header('Content-type: application/json');
        echo json_encode($result);

    }

    public function contactParUtilisateur(){

        $result = $this->Contact_model->selectContactParUtilisateur();

        header('Content-type: application/json');
        echo json_encode($result);
    }

    public function rendezVousParUtilisateur(){
        $result = $this->RendezVous_model->nombreRdvPrisParUtilisateur();

        header('Content-type: application/json');
        echo json_encode($result);
    }
}