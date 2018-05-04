<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');   
		$this->load->model('audio_model','audio');
	}

	public function index()
	{
		if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'/main/login/');
        } 
        
        $titulo['titulo'] = "Upload questions"; 
        $datos['error'] = "";
        
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        // cargamos  la interfaz y le enviamos los datos
        $this->load->view('upload_audio_form',  $datos);   
	}


    public function upload()
    {
        if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'/main/login/');
        } 

        $datos['alumno'] = $this->input->post('frase');
        $datos['frase'] = 'piña y tengo $name$ años';

        
        //$q = $this->db->get_where('answer', array('id' => '134'), 1);  
        //$datos['frase']= $q->row()->answer;
        //echo $datos['ejemplo']; echo "<br>"; echo "<br>";
        $titulo['titulo'] = "Upload questions"; 

       
            //compara del 0 al 13 
            //echo strncmp($porciones[0], substr($datos['alumno'],0, $long[0] ),$long[0]);
          
            //echo "<br>";
            //substr coge del 13 6 caracteres
            // y luego compara del 0 al 6
            //echo strncmp($porciones[1], substr($datos['alumno'],$long[0], $long[1]), $long[1]);
            //echo "<br>";

            //echo strncmp($porciones[2], substr($datos['alumno'],$long[0]+$long[1], $long[2]), $long[2]);
            //echo "<br>";

            /*
            echo "<br>";
            echo "long 0 = ".$long[0]; //13
            echo "<br>";
            echo "long 1 = ".$long[1]; //6

            echo "<br>";
            echo "array tamaño= ".$resultado; */
        
        $valor = validate_name('Pastor');
        echo "el resultado es: ".$valor;
        echo var_dump($valor);

        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        // cargamos  la interfaz y le enviamos los datos
        $this->load->view('upload_audio_form_1',  $datos); 
    }

    private function validar_frase($frasealumno, $frasecorrecta)
    {
        $array = array(
                    "time" => 5,
                    "name" => 4,
                );

        $findme   = '$';
        $pos = strpos($frasecorrecta, $findme);

        //el if comprueba que sea una frase que tenga $
        if ($pos === false) {
            echo "La cadena '$findme' no fue encontrada en la cadena 'mystring'";
        }else 
        {
            $porciones = explode("$", $frasecorrecta);
            $resultado = count($porciones); //tamaño del array
           
           /*
            echo "la porcion es:".$resultado;
            echo var_dump($porciones);
            echo "<br>";
            
                echo $porciones[0]; // porción1: mi nombre es
                echo "<br>";
                echo $porciones[1]; // porción2: nombre
                echo "<br>";
                echo $porciones[2]; // porción3: piña y tengo
                echo "<br>";
            */
                
            for ($i = 0; $i < $resultado; $i++) //averigua el tamaño de las porciones
            {
                $long[$i] = strlen($porciones[$i]);
            }

            $cont = 0;
            $verdadero = TRUE;

            //no hace falta el if porque el explode pone espacio en blanco al principio si hay un $ primero
            /*
            if (array_key_exists($porciones[0], $array))
            {
                echo "la variable esta en zona par";
            }
            else
            {*/

            for ($i = 0; $i < $resultado && $verdadero; $i++) 
            {   
                if($i%2==0)
                {
                    echo "resultado 1: ".$verdadero;
                    echo "<br>";

                    echo "___frase: ".$porciones[$i];
                    echo "<br>";
                    echo "___alumno: ".substr($frasealumno,$cont, $long[$i])." ";
                    echo "<br>";
                    echo "___parte ".$i.": "; 
                    if(strncmp($porciones[$i], substr($frasealumno,$cont, $long[$i] ),$long[$i]) != 0)
                    {
                        $verdadero = 0;
                    }
                    echo strncmp($porciones[$i], substr($frasealumno,$cont, $long[$i] ),$long[$i]);
                    echo "<br>";
                    echo "resultado 2: ".$verdadero;
                    echo "<br>";
                    $cont = $cont + $long[$i];
                }
                else
                {
                    echo "---------impar: ".strlen($porciones[$i]);
                    echo "<br>";
                    $cont = $cont + strlen($porciones[$i]);
                }
            }
        }

        return $verdadero;

    }


    /**
     * Valida los campos del input y devuelve los errores
     *
     * @return array con los datos del error
    */ 
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if(!empty($_FILES))
        {

            if( $_FILES['file']['type'] != 'audio/mpeg')
            {
                $data['inputerror'][] = 'file';
                $data['error_string'][] = $_FILES['file']['type'];
                $data['status'] = FALSE;
            }

        }

        

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}




