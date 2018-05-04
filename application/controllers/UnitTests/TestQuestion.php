<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestQuestion extends CI_Controller {

    public function __construct() 
    { 
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->model("Question_model");
    }

    public function testQuestion()
    {
        $question_id = 5;
        $test_name = "Devolver el nombre de la categoria dado el id de la pregunta";
        $expected = 'is_object';
        $category = $this->Question_model->get_category_by_id($question_id);
        echo $this->unit->run($category, $expected, $test_name);

    /*--------------------------------------------------------------*/

        $question_id = 11;
        $test_name = "Devolver el nombre de la pregunta cuyo id conincide con el dado";
        $expected = 'is_object';
        $category = $this->Question_model->get_question_name($question_id);
        echo $this->unit->run($category, $expected, $test_name);

    /*--------------------------------------------------------------*/

        $category_id = 5;
        $test_name = "Devolver el numero de la categoria cuyo id conincide con el dado";
        $expected = 'is_object';
        $number = $this->Question_model->get_category_number($category_id);
        echo $this->unit->run($number, $expected, $test_name);

    /*--------------------------------------------------------------*/

        $question_id = 10;
        $test_name = "Devolver todas las respuestas de una pregunta dado el id de la pregunta";
        $expected = 'is_array';
        $answers = $this->Question_model->get_answers_by_id($question_id);
        echo $this->unit->run($answers, $expected, $test_name);

    /*--------------------------------------------------------------*/

        $question_id = 10;
        $test_name = "Devolver l nombre del audio con la extension dado el id de la pregunta";
        $expected = 'is_array';
        $notes = 'Se va a probar que ocurre si se le envía un id de una pregunta que no tiene audio. En este caso, como no existe dicho audio en la BD, el valor devuelto sera null y por ello el test no se pasará. Lo que prueba que la función actúa como corresponde.';
        $answers = $this->Question_model->get_audio_name($question_id);
        echo $this->unit->run($answers, $expected, $test_name, $notes);

    /*--------------------------------------------------------------*/

        $question_id = 10;
        $test_name = "Devolver todas las respuestas de una pregunta dado el id de la pregunta";
        $expected = 'is_array';
        $answers = $this->Question_model->get_answers_by_id($question_id);
        echo $this->unit->run($answers, $expected, $test_name);

    }
}