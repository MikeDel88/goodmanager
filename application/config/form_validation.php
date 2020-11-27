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
        )

);
