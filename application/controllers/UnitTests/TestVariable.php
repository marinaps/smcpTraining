<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestVariable extends CI_Controller {

    public function __construct() 
    { 
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->model("Variable_model");
    }

    public function testVariable()
    {
        $variable_id = 1;
        $test_name = "Devolver todos los ejemplos de una variable dado el id del tipo de variable.";
        $expected = 'is_array';
        $variables = $this->Variable_model->get_variables($variable_id);
        echo $this->unit->run($variables, $expected, $test_name);

    /*--------------------------------------------------------------*/

        $variable_id = 1;
        $test_name = "Devolver el nombre del tipo de variable dado su id.";
        $expected = 'is_object';
        $variable_name = $this->Variable_model->get_type_variable_name($variable_id);
        echo $this->unit->run($variable_name, $expected, $test_name);

    }
}