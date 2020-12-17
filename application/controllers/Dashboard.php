<?php
declare(strict_types = 1);
defined('BASEPATH') or exit('No direct script access allowed');



/**
 * Dashboard
 * Affiche la page de la Dashboard
 */
class Dashboard extends MY_Controller
{

    
    /**
     * __construct
     *  Défini le css, js et le layout
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->layout->set_js(base_url() . "assets/js/dashboard.js");
        $this->layout->set_theme("back-office");
    }
    
    /**
     * index
     *  Affiche la page du tableau de bord
     * @return void
     */
    public function index() :void
    {
        $this->layout->set_title("GoodManager | Tableau de bord");
        $this->layout->set_page("Les Analyses");
        $this->layout->view('dashboard');
    }
    
    /**
     * newClients
     * Tableau qui renvoi en JSON
     * le nombre de nouveaux clients sur différentes années
     *
     * @return void
     */
    public function newClients() :void
    {
        $result = $this->Client_model->selectNewClientByYear();

        header('Content-type: application/json');
        echo json_encode($result);
    }
    
    /**
     * NumberClientsByYear
     * Renvoi en JSON le nombre de clients par an
     *
     * @param  mixed $datas
     * @return void
     */
    public function numberClientsByYear(string $datas)
    {
        $results = [];
        $annees = explode("-", $datas);
        foreach ($annees as $annee) {
            $results[] = [
                'annee' => $annee,
                'nombre' => $this->Client_model->selectNumberClientByYear($annee),
            ];
        }
        header('Content-type: application/json');
        echo json_encode($results);
    }
    
    /**
     * NumberClientByDept
     *  Génère le nombre de clients par département
     * @return void
     */
    public function numberClientByDept() :void
    {
        $result = $this->Client_model->selectNombreClientByDept();

        header('Content-type: application/json');
        echo json_encode($result);
    }
    
    /**
     * SansTelNiMail
     * Renvoi en JSON le nombre de clients sans téléphone, sans mail, et les deux
     * @return void
     */
    public function sansTelNiMail() :void
    {
        $result = [];

        $sansTel = $this->Client_model->selectSansInfo('telephone');
        $sansEmail = $this->Client_model->selectSansInfo('email');
        $sansTelNiMail = $this->Client_model->selectSansTelNiMail('telephone', 'email');

        $result[] = $sansTel;
        $result[] = $sansEmail;
        $result[] = $sansTelNiMail;

        header('Content-type: application/json');
        echo json_encode($result);
    }
    
    /**
     * contactParUtilisateur
     *  renvoi en JSON le nombre de contact client par utilisateur
     * @return void
     */
    public function contactParUtilisateur() :void
    {
        $result = $this->Contact_model->selectContactParUtilisateur();

        header('Content-type: application/json');
        echo json_encode($result);
    }
    
    /**
     * rendezVousParUtilisateur
     *  Renvoi en JSON le nombre de rendez-vous par utilisateur
     * @return void
     */
    public function rendezVousParUtilisateur() :void
    {
        $result = $this->RendezVous_model->nombreRdvPrisParUtilisateur();

        header('Content-type: application/json');
        echo json_encode($result);
    }
}
