<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestAnswer extends CI_Controller {

    public function __construct() 
    { 
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->model("Answer_model");
    }

    public function testAnswer()
    {
        $answer_id = 13;
        $test_name = "Devolver la respuesta cuyo id conincide con el dado";
        $expected = 'is_object';
        $answer = $this->Answer_model->get_answer_by_id($answer_id);
        echo $this->unit->run($answer, $expected, $test_name);

    /*--------------------------------------------------------------*/

        $user_mail = 10;
        $test_name = "Devolver la pregunta cuyo id conincide con el dado";
        $expected = 'is_object';
        $user = $this->Answer_model->get_question($user_mail);
        echo $this->unit->run($user, $expected, $test_name);
    
    }
}