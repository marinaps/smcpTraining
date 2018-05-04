<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestConfiguration extends CI_Controller {

    public function __construct() 
    { 
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->model("Configuration_model");
    }

    public function testConfiguration()
    {
        $test_name = "Obtener todas las categorias del final test.";
        $expected = 'is_array';
        $category = $this->Configuration_model->get_final_test_categories();
        echo $this->unit->run($category, $expected, $test_name);
    }
}