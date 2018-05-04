<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestChat extends CI_Controller {

    public function __construct() 
    { 
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->model("Chat_model");
    }

    public function testChat()
    {
        $category_id = 13;
        $test_name = "Devolver 5 preguntas true/false para el training mode dada una categoria";
        $expected = 'is_array';
        $question = $this->Chat_model->get_tf_questions_by_category($category_id);
        echo $this->unit->run($question, $expected, $test_name);

    /*--------------------------------------------------------------*/

        $user_mail = 10;
        $test_name = "Devolver todas las respuestas correctas de la frase/pregunta dado el id de una pregunta";
        $expected = 'is_array';
        $user = $this->Chat_model->get_correct_answers($user_mail);
        echo $this->unit->run($user, $expected, $test_name);
    
    }
}