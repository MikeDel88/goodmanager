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
                        'label' => 'password',
                        'rules' => 'trim|required|min_length[8]|max_length[16]'
                ),
                array(
                        'field' => 'password_repeat',
                        'label' => 'password_repeat',
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
                        'label' => 'password',
                        'rules' => 'trim|required|min_length[8]|max_length[16]'
                ),
                array(
                        'field' => 'password_repeat',
                        'label' => 'password_repeat',
                        'rules' => 'trim|required|matches[password]'
                )
        ),
        'profile/miseAJourEntreprise' => array(
                array(
                        'field' => 'name',
                        'label' => 'name',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'address',
                        'label' => 'address',
                        'rules' => 'trim'
                ),
                array(
                        'field' => 'zipcode',
                        'label' => 'zipcode',
                        'rules' => 'trim|exact_length[5]'
                ),
                array(
                        'field' => 'city',
                        'label' => 'city',
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
                        'label' => 'last_name',
                        'rules' => 'trim|required' 
                ),
                array(
                        'field' => 'first_name',
                        'label' => 'first_name',
                        'rules' => 'trim|required' 
                ),
        ),
        'gestion/add' => array(
                array(
                        'field' => 'last_name',
                        'label' => 'last_name',
                        'rules' => 'trim|required' 
                ),
                array(
                        'field' => 'first_name',
                        'label' => 'first_name',
                        'rules' => 'trim|required' 
                ),
                array(
                        'field' => 'birthday',
                        'label' => 'birthday',
                        'rules' => 'trim|required' 
                ),
                array(
                        'field' => 'address',
                        'label' => 'address',
                        'rules' => 'trim' 
                ),
                array(
                        'field' => 'zipcode',
                        'label' => 'zipcode',
                        'rules' => 'trim|exact_length[5]'
                ),
                array(
                        'field' => 'city',
                        'label' => 'city',
                        'rules' => 'trim'
                ),
                array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'trim|valid_email' 
                ),
                array(
                        'field' => 'phone',
                        'label' => 'phone',
                        'rules' => 'trim|exact_length[10]' 
                ),

        ),
        'fiche/update' => array(
                array(
                        'field' => 'last_name',
                        'label' => 'last_name',
                        'rules' => 'trim|required' 
                ),
                array(
                        'field' => 'first_name',
                        'label' => 'first_name',
                        'rules' => 'trim|required' 
                ),
                array(
                        'field' => 'birthday',
                        'label' => 'birthday',
                        'rules' => 'trim|required' 
                ),
                array(
                        'field' => 'address',
                        'label' => 'address',
                        'rules' => 'trim' 
                ),
                array(
                        'field' => 'zipcode',
                        'label' => 'zipcode',
                        'rules' => 'trim|exact_length[5]'
                ),
                array(
                        'field' => 'city',
                        'label' => 'city',
                        'rules' => 'trim'
                ),
                array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'trim|valid_email' 
                ),
                array(
                        'field' => 'phone',
                        'label' => 'phone',
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
                        'label' => 'search',
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
                        'label' => 'last_name',
                        'rules' => 'trim|required' 
                ),
                array(
                        'field' => 'first_name',
                        'label' => 'first_name',
                        'rules' => 'trim|required' 
                ),
        )

);
