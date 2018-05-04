<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestUser extends CI_Controller {

    public function __construct() 
    { 
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->model("User_model");
    }

    public function testUser()
    {
        $user_id = 1;
        $test_name = "Obtener usuario por su id";
        $expected = 'is_object';
        $user = $this->User_model->get_by_id($user_id);
        echo $this->unit->run($user, $expected, $test_name);

    /*--------------------------------------------------------------*/

        $user_id = 1;
        $test_name = "Comprobar si un usuario puede ser eliminado";
        $expected = 'is_false';
        $user = $this->User_model->get_user_info($user_id);
        echo $this->unit->run($user, $expected, $test_name);

    /*--------------------------------------------------------------*/

        $user_id = 1;
        $test_name = "Devolver el role del usuario dado su id";
        $expected = 'is_object';
        $user = $this->User_model->get_role($user_id);
        echo $this->unit->run($user, $expected, $test_name);

    /*--------------------------------------------------------------*/

        $user_mail = 'ejemplo@gmail.com';
        $test_name = "Comprobar si un email esta ya almacenado en la BD";
        $expected = 'is_false';
        $user = $this->User_model->isDuplicate($user_mail);
        echo $this->unit->run($user, $expected, $test_name);

    /*--------------------------------------------------------------*/

        $user_mail = 'prueba@gmail.com';
        $test_name = "Devolver el id de un usuario dado su email";
        $expected = 'is_object';
        $user = $this->User_model->get_id_by_email($user_mail);
        echo $this->unit->run($user, $expected, $test_name);
    }
}