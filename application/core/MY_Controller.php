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

    public function getInput(){
        $input_data = json_decode(trim(file_get_contents('php://input')), true);
        return $input_data;
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
            if($post == 'birthday'){
                $data['birthday'] = date("Y-m-d", strtotime($value));
            }else{
                $data[$post] = html_escape(strtolower($value));
            }
            
        }
        return $data;
    }
    
    /**
     * coordonnees
     *  Transforme une adresse en coordonnees lat et lon
     * @param  mixed $address
     * @param  mixed $zipcode
     * @param  mixed $city
     * @return void
     */
    public function coordonnees($address, $zipcode, $city) :array{
            $adresse = array(
                  'street'     => $address,
                  'postalcode' => $zipcode,
                  'city'       => $city,
                  'country'    => 'france',
                  'format'     => 'json',
                );

                $url = 'https://nominatim.openstreetmap.org/?' . http_build_query($adresse);
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERAGENT, $this->agent->agent_string());
                $geopos = curl_exec($ch);
                curl_close($ch);
                $json_data = json_decode($geopos, true);

                // Mettre une alerte si l'adresse n'est pas reconnu
                
                $data['lat'] = $json_data[0]['lat'];
                $data['lng'] = $json_data[0]['lon'];

                return $data;
    }
}