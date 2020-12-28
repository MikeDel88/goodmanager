<?php


class Entreprise_model_test extends TestCase
{
    protected $CI;

    public function setUp()
    { 

        $this->resetInstance();
        $this->CI->load->model('Entreprise_model');
        $this->obj = $this->CI->Entreprise_model;

    }

    public function testEntrepriseRegister()
    {
        $except =[
            'nom' => 'EntrepriseTest2'
        ];
        $this->assertEquals($this->obj->register($except), true);
    }
}