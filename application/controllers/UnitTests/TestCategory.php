<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestCategory extends CI_Controller {

    public function __construct() 
    { 
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->model("Category_model");
    }

    public function testCategory()
    {
        $test_name = "Obtener todas las categorias";
        $expected = 'is_array';
        $category = $this->Category_model->get_categories();
        echo $this->unit->run($category, $expected, $test_name);

    /*--------------------------------------------------------------*/

        $category_id = 1;
        $test_name = "Obtener categoria por su id";
        $expected = 'is_array';
        $category = $this->Category_model->get_category_by_id($category_id);
        echo $this->unit->run($category, $expected, $test_name);
    }
}