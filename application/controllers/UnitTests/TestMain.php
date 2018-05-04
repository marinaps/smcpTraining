<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestMain extends CI_Controller {

    public function __construct() 
    { 
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->model("Main_model");
    }

    public function testMain()
    {
        $user_mail = 'prueba@gmail.com';
        $test_name = "Devolver los datos de un usuario dado su email";
        $expected = 'is_object';
        $user = $this->Main_model->getUserInfoByEmail($user_mail);
        echo $this->unit->run($user, $expected, $test_name);
    }
}