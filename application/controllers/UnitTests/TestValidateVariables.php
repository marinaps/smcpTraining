<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestValidateVariables extends CI_Controller {

    public function __construct() 
    { 
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->model("Chat_model");
    }

    public function testValidateVariables()
    {
        $test_name = 'Validar las variables que son restrictivas.';
        $typevariable = 'charted name';
        $variable = 'ALFA5';
        $expected = 'is_true';
        $validate = validate_restricted($typevariable, $variable);
        echo $this->unit->run($validate, $expected, $test_name);

        /*--------------------------------------------------------------*/

        $test_name = 'Validar una variable restrictiva incorrecta.';
        $typevariable = 'charted name';
        $variable = 'SEA2';
        $expected = 'is_true';
        $notes = 'Se va a probar que ocurre si se le envía una variable incorrecta a la función. En este caso, como la respuesta enviada no corresponde con ninguna almacenada en la BD, el valor devuelto sera FALSE y por ello el test no se pasará. Lo que prueba que la función actúa como corresponde.';
        $validate = validate_restricted($typevariable, $variable);
        echo $this->unit->run($validate, $expected, $test_name, $notes);

        /*--------------------------------------------------------------*/

        $test_name = 'Validar force beaufort.';
        $beaufort = 9;
        $expected = 'is_true';
        $validate = validate_beaufort($beaufort);
        echo $this->unit->run($validate, $expected, $test_name);

        /*--------------------------------------------------------------*/

        $test_name = 'Validar una fecha.';
        $date = 'April 18th';
        $expected = 'is_true';
        $validate = validate_date($date);
        echo $this->unit->run($validate, $expected, $test_name);

        /*--------------------------------------------------------------*/

        $test_name = 'Validar una fecha incorrecta.';
        $date = 'April 12nd';
        $expected = 'is_true';
        $notes = 'Se va a probar que ocurre si se le envía una fecha incorrecta a la función. En este caso, como la respuesta enviada no corresponde con una fecha correcta el valor devuelto sera FALSE y por ello el test no se pasará. Lo que prueba que la función actúa como corresponde.';
        $validate = validate_date($date);
        echo $this->unit->run($validate, $expected, $test_name, $notes);

        /*--------------------------------------------------------------*/

        $test_name = 'Validar una hora.';
        $time = '1232';
        $expected = 'is_true';
        $validate = validate_time($time);
        echo $this->unit->run($validate, $expected, $test_name);
    
    }
}