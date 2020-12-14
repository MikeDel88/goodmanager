<?

$config = array(
        'inscription/index' => array(
                array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'trim|required|valid_email'
                ),
                array(
                        'field' => 'entreprise',
                        'label' => 'entreprise',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'password',
                        'label' => 'mot de passe',
                        'rules' => 'trim|required|min_length[8]|max_length[16]'
                ),
                array(
                        'field' => 'password_repeat',
                        'label' => 'confirmation mot de passe',
                        'rules' => 'trim|required|matches[password]'
                )
        ),
        'connexion/index' => array(
                array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'trim|required|valid_email' 
                ),
                array(
                        'field' => 'password',
                        'label' => 'password',
                        'rules' => 'trim|required'
                ),
        ),
        'connexion/reset' => array(
                array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'trim|required|valid_email' 
                ),
        ),
        'connexion/modification' => array(
                array(
                        'field' => 'password',
                        'label' => 'mot de passe',
                        'rules' => 'trim|required|min_length[8]|max_length[16]'
                ),
                array(
                        'field' => 'password_repeat',
                        'label' => 'confirmation mot de passe',
                        'rules' => 'trim|required|matches[password]'
                )
        ),
        'profile/miseAJourEntreprise' => array(
                array(
                        'field' => 'name',
                        'label' => 'nom',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'address',
                        'label' => 'adresse',
                        'rules' => 'trim'
                ),
                array(
                        'field' => 'zipcode',
                        'label' => 'code postal',
                        'rules' => 'trim|exact_length[5]'
                ),
                array(
                        'field' => 'city',
                        'label' => 'ville',
                        'rules' => 'trim'
                ),
                
        ),
        'profile/miseAJourUser' => array (
                array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'trim|required|valid_email' 
                ),
                array(
                        'field' => 'last_name',
                        'label' => 'nom',
                        'rules' => 'trim|required' 
                ),
                array(
                        'field' => 'first_name',
                        'label' => 'prénom',
                        'rules' => 'trim|required' 
                ),
        ),
        'gestion/add' => array(
                array(
                        'field' => 'last_name',
                        'label' => 'nom',
                        'rules' => 'trim|required' 
                ),
                array(
                        'field' => 'first_name',
                        'label' => 'prénom',
                        'rules' => 'trim|required' 
                ),
                array(
                        'field' => 'birthday',
                        'label' => 'date anniversaire',
                        'rules' => 'trim|required' 
                ),
                array(
                        'field' => 'address',
                        'label' => 'adresse',
                        'rules' => 'trim' 
                ),
                array(
                        'field' => 'zipcode',
                        'label' => 'code postal',
                        'rules' => 'trim|exact_length[5]'
                ),
                array(
                        'field' => 'city',
                        'label' => 'ville',
                        'rules' => 'trim'
                ),
                array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'trim|valid_email' 
                ),
                array(
                        'field' => 'phone',
                        'label' => 'téléphone',
                        'rules' => 'trim|exact_length[10]' 
                ),

        ),
        'fiche/update' => array(
                array(
                        'field' => 'last_name',
                        'label' => 'nom',
                        'rules' => 'trim|required' 
                ),
                array(
                        'field' => 'first_name',
                        'label' => 'prénom',
                        'rules' => 'trim|required' 
                ),
                array(
                        'field' => 'birthday',
                        'label' => 'date anniversaire',
                        'rules' => 'trim|required' 
                ),
                array(
                        'field' => 'address',
                        'label' => 'adresse',
                        'rules' => 'trim' 
                ),
                array(
                        'field' => 'zipcode',
                        'label' => 'code postal',
                        'rules' => 'trim|exact_length[5]'
                ),
                array(
                        'field' => 'city',
                        'label' => 'ville',
                        'rules' => 'trim'
                ),
                array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'trim|valid_email' 
                ),
                array(
                        'field' => 'phone',
                        'label' => 'téléphone',
                        'rules' => 'trim|exact_length[10]' 
                ),
        ),
        'fiche/delete' => array(
                array(
                        'field' => 'id',
                        'label' => 'id',
                        'rules' => 'trim|required' 
                ),  
        ),
        'liste/search' => array(
                array(
                        'field' => 'search',
                        'label' => 'recherche',
                        'rules' => 'trim',
                ),
                array(
                        'field' => 'select-search',
                        'label' => 'select-search'
                )
        ),
        'comptes/add' => array(
                array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'trim|valid_email' 
                ),
                array(
                        'field' => 'last_name',
                        'label' => 'nom',
                        'rules' => 'trim|required' 
                ),
                array(
                        'field' => 'first_name',
                        'label' => 'prénom',
                        'rules' => 'trim|required' 
                ),
        )

);
