<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {
        
    public $status; 
    public $roles;

    function __construct(){
        parent::__construct();
        $this->load->model('chat_model', 'chat', TRUE);
        $this->load->model('result_model', 'result', TRUE);
        $this->load->library('form_validation');    
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->status = $this->config->item('status'); 
        $this->roles = $this->config->item('roles');

        //Enunciados de los ejericios
        $this->enun_disordered = "Arrange the words in the correct SMCP order: ";
        $this->enun_tf = "Select the correct SMCP phrase."; 
        $this->enun_audio_write = "Listen and write the SMCP phrase";

        $this->enun_question_3answers = "Select the right answer to the corresponding question.";
        $this->enun_question_tf_answer = "According to the SMCP question, decide whether the SMCP reply is Correct or Incorrect";
        $this->enun_q_a = "Write the right answer:";
    }      


    /**
     * Metodo index que muestra el menu de selccion del modo de juego (training o final test)
     *
    */  
    public function index()
    {   
        if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'main/login/');
        }
   
        $titulo['titulo'] = "SMCP Training Start Test"; 
        /*front page*/
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        $this->load->view('mode_menu'); //Menu de seleccion del modo de juego
    }


    /**
     * Muestra el menu de seleccion del nivel (dentro del training mode)
     *
     * Una vez seleccionado el training mode muestra un menu con los tres niveles 
     * disponibles: pattern, association e inter-association level
     *
    */  
    public function select_level() 
    {   
        if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'main/login/');
        }

        $datos['arrcategories'] = $this->chat->get_categories();
   
        $titulo['titulo'] = "Level"; 
        /*front page*/
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        $this->load->view('select_level_menu', $datos);     
    }

    /**
     * Comprueba si se ha seleccionado una categoria o no
     *
    */
    public function check_category($category)
    {
        $this->_validate_category($category);
        echo json_encode(array("status" => TRUE));
    }

    /**
     * Valida los campos del input y devuelve los errores
     *
     * @return array con los datos del error
    */  
    private function _validate_category($category)
    {
       
        switch ($category) 
        {
            case "pattern":
                $text = "category_id_pattern";
                break;
            case "association":
                $text = "category_id_association";
                break;
        }
            
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post($text) == '')
        {
            $data['inputerror'][] = $text;
            $data['error_string'][] = 'The category is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    /**
     * Recibe el id de una categoria, obtiene las preguntas del test y las muestra para el nivel pattern
     *
     * @param string $id_category con el id de la categoria
    */ 
    public function pattern_level($id_category)
    {
        if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'main/login/');
        }
        $titulo['titulo'] = "SMCP Training"; 

        //Enunciados de cada ejercicio
        $datos['enun_disordered'] = $this->enun_disordered;
        $datos['enun_tf'] = $this->enun_tf;
        $datos['enun_audio_write'] = $this->enun_audio_write;

        $categories = get_children_ids_pattern($id_category);

        //Preguntas de cada ejercicio
        $marina = $this->chat->get_disordered_questions_by_category1($categories);
        //echo var_dump($marina);
        //echo $marina[0]->answer;
        //$marina[0]->answer="hola marina";
        //echo $marina[0]->answer;
        /*foreach ($marina as $key) 
        {
           echo var_dump($key);
           echo "------------------------------";
        }*/
        $datos['tf_questions'] = $this->chat->get_tf_questions_by_category($categories);
        $datos['audio_write_questions'] = $this->chat->get_audio_write_questions_by_category($categories);
        //Id y nombre de la categoria
        $datos['category_id'] = $id_category;
        $datos['category_name'] = $this->chat->get_category_name($id_category);
        //Id y nombre de la categoria

        //Si no hay preguntas muestra un error
        if($datos['disordered_questions'] == null && $datos['tf_questions'] == null && $datos['audio_write_questions'] == null)
        {   
            echo "error con las preguntas.";
        }
        else
        {
            $datos['num_preguntas'] = count($datos['disordered_questions']) + count($datos['tf_questions']) + count($datos['audio_write_questions']);
            
        }
        $this->session->set_flashdata('contador', '1');

   
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        $this->load->view('pattern_level_view', $datos);      
    }

    /**
     * Recibe el id de una categoria, obtiene las preguntas del test y las muestra para el nivel associaion
     *
     * @param string $id_category con el id de la categoria
    */ 
    public function association_level($id_category)
    {

        if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'main/login/');
        }
        $titulo['titulo'] = "SMCP Training"; 

        //Enunciados
        $datos['enun_question_3answers'] = $this->enun_question_3answers;
        $datos['enun_question_tf_answer'] = $this->enun_question_tf_answer;
        $datos['enun_q_a'] = $this->enun_q_a;


        $categories = get_children_ids($id_category);
        $datos['category_name'] = $this->chat->get_category_name($id_category);
        $datos['category_id'] = $id_category;

        $datos['question_answer'] = $this->chat->get_question_by_category($categories);

        if($datos['question_answer'] == null )
        //&& $datos['tf_questions'] == null && $datos['audio_write_questions'] == null)
        {   
            echo "error con las preguntas.";
        }
        else
        {
            //$datos['idexam'] = $this->chat->createexam_association($datos);
            $datos['num_preguntas'] = count($datos['question_answer']); 
        }
   
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        $this->load->view('association_level_view', $datos);      
    }


  
    public function result_display_pattern()
    {
        if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'main/login/');
        }
        $id_category = $this->input->post('category_id');
        $num_preguntas = $this->input->post('cantidad');

        $id_exam =$this->chat->createexam_pattern($id_category);

        if($_SESSION['contador'] == 1)
        {
        //Enunciados de cada ejercicio
        $this->data['enun_disordered'] = $this->enun_disordered;
        $this->data['enun_tf'] = $this->enun_tf;
        $this->data['enun_audio_write'] = $this->enun_audio_write;

        $this->data['category_name'] = $this->chat->get_category_name($id_category);


        $correctas = 0;
        $incorrectas = 0;

        $desordenadas = 0;
        $true_false = 0;
        $audio = 0;

        $this->data['disordered_questions'] = array(); //Array para almacenar todas las preguntas
        $this->data['truefalse_questions'] = array(); //Array para almacenar todas las preguntas
        $this->data['audio_questions'] = array(); //Array para almacenar todas las preguntas

        for($i=1; $i<$num_preguntas+1; $i++)  //Comprueba cuantas son correctas e incorrectas y crea los entries
        {
            if($this->input->post('type'.$i.'') == 'disordered')
            {   
                $desordenadas++;

                $post = $this->input->post('quizid'.$i.''); //respuesta dada
                
                $id = $this->input->post('id'.$i.''); //id de la pregunta

                array_push($this->data['disordered_questions'], $this->chat->get_disordered_byid($id)); //Busca en la BD la pregunta por el id y almacena todos los campos de esta pregunta en el array
            
                if(correct_disordered($id, $post, $id_exam))
                {
                    $correctas++;
                }
                else
                {
                    $incorrectas++;
                }

            }
            if($this->input->post('type'.$i.'') == 'truefalse')
            {
                $true_false++;

                $post = $this->input->post('quizid'.$i.''); //respuesta dada
               
                $id = $this->input->post('id'.$i.'');  //id de la pregunta

                array_push($this->data['truefalse_questions'], $this->chat->get_truefalse_byid($id)); //Busca en la BD la pregunta por el id y almacena todos los campos de esta pregunta en el array

                if(correct_truefalse($id, $post, $id_exam))
                {
                    $correctas++;
                }
                else
                {
                    $incorrectas++;
                }
            }

            if($this->input->post('type'.$i.'') == 'audio_write')
            {
                $audio++;
                $post = $this->input->post('quizid'.$i.''); //respuesta dada
               
                $id = $this->input->post('id'.$i.'');  //id de la pregunta

                array_push($this->data['audio_questions'], $this->chat->get_question_byid($id)); //Busca en la BD la pregunta por el id y almacena todos los campos de esta pregunta en el array

               if(correct_audioquestions($id, $post, $id_exam))
                {
                    $correctas++;
                }
                else
                {
                    $incorrectas++;
                }
                
            }
        }
       
        $this->chat->update_exam($id_exam, $correctas, $num_preguntas, null);

        $this->data['num_questions'] = $num_preguntas;
        $this->data['desordenadas'] = $desordenadas;
        $this->data['true_false'] = $true_false;
        $this->data['audio'] = $audio;

        $this->data['category'] =  $id_category;
        $this->data['id_examen'] =  $id_exam;

        $this->data['respuestas'] = $this->chat->get_entries_respuestas($id_exam);
        $this->data['correct'] =  $correctas;

        $titulo['titulo'] = "Results"; 
        
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        $this->load->view('result_display_pattern', $this->data);
        }
               
    }


    public function result_display_association()
    {
        if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'main/login/');
        }

        $id_category = $this->input->post('exam_category');
        $num_preguntas = $this->input->post('cantidad');

        $id_exam = $this->chat->createexam_association($id_category);

        $this->data['category_name'] = $this->chat->get_category_name($id_category);


        $correctas = 0;
        $incorrectas = 0;

        $question_answer = 0;
        //$true_false = 0;
        //$question_3answer = 0;

        $this->data['questions'] = array(); //Array para almacenar todas las preguntas
        $this->data['correct_answers'] = array(); //Array para almacenar todas las respuestas correctas
        $this->data['examples_answers'] = array();  //Array para almacenar las respuestas ejeplos para los resultados

        for($i=1; $i<$num_preguntas+1; $i++)  //Comprueba cuantas son correctas e incorrectas y crea los entries
        {
            if($this->input->post('type'.$i.'') == 'question_answer')
            {   
                $question_answer++;

                $respuesta_dada = $this->input->post('quizid'.$i.''); //respuesta dada
                
                $id = $this->input->post('id'.$i.''); //id de la pregunta

                array_push($this->data['questions'], $this->chat->get_question_byid($id)); //Busca en la BD la pregunta por el id y almacena todos los campos de esta pregunta en el array
                
                
                $correct_answers = $this->chat->get_correct_answers($id); //Devuelve todas las respuestas correctas de la pregunta dada por el id. 
                $this->data['correct_answers'] = array_merge($this->data['correct_answers'], $correct_answers);
                //array_push($this->data['correct_answers'], $correct_answers); 
                

                $answer = $this->chat->get_one_correct_answer($id);

                if(strpos($answer['answer'], '$'))
                {
                    $porciones = explode("$", $answer['answer']);
                    $num = count($porciones); //tamaño del array porciones

                    for ($j = 0; $j < $num; $j++) 
                    {   
                        if($j%2 != 0)
                        {   
                            $id_type_variable = $this->chat->get_id_type_variable($porciones[$j]);
                            $variable_example = $this->chat->get_variable_example($id_type_variable->id);

                            $answer['answer'] = str_replace("$".$porciones[$j]."$", $variable_example->name, $answer['answer']);                         
                        }
                    }
                    $this->data['examples_answers'][] =  $answer['answer'];

                }
                else
                {
                    $this->data['examples_answers'][] =  $answer['answer'];
                }
                
                $es_correcta=FALSE;
                foreach ($correct_answers as $row)
                {   
                    if( ! $es_correcta)
                    $es_correcta= validar_frase($respuesta_dada, $row['answer']);
                }

                if($es_correcta)
                {
                    $correctas = $correctas + 1;
                    $entry = array(
                        'answer' => $respuesta_dada,
                        'correct' => TRUE
                        );
                }
                else
                {
                    $incorrectas = $incorrectas + 1;
                    $entry = array(
                        'answer' => $respuesta_dada,
                        'correct' => FALSE
                        );
                }
                $this->chat->create_entry($id_exam, $id, $entry, 1);

            }

        }

        $this->chat->update_exam($id_exam, $correctas, $num_preguntas, null);

        $this->data['num_questions'] = $num_preguntas;
        $this->data['question_answer'] = $question_answer;
        //$this->data['true_false'] = $true_false;
        //$this->data['question_3answer'] = $TRUE_FALSE;


        $this->data['category'] =  $id_category;
        $this->data['idexam'] =  $id_exam;
        $this->data['respuestas'] = $this->chat->get_entries_respuestas($id_exam);
        $this->data['correct'] =  $correctas;

        $titulo['titulo'] = "Results associaion level"; 
        
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        $this->load->view('result_display_association', $this->data);
               
    }


    

    //Esta función obtiene las preguntas y las muestra del test final
    public function final_test()
    {
        $titulo['titulo'] = "Final test exam"; 

        if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'main/login/');
        }

        $datos['enun_disordered'] = $this->enun_disordered;
        $datos['enun_tf'] = $this->enun_tf;
        $datos['enun_audio_write'] = $this->enun_audio_write;
        $datos['enun_question_3answers'] = $this->enun_question_3answers;
        $datos['enun_question_tf_answer'] = $this->enun_question_tf_answer;
        $datos['enun_q_a'] = $this->enun_q_a;



        $categorias_preguntas = [
                                    //"6.2.1.1",
                                    //"6.2.1.2",
                                    //"6.2.1.3",
                                    //"6.2.1.4",
                                    //"6.2.1.5",
                                        "2",
                                ];
        $categorias_ids = array();

        foreach ($categorias_preguntas as $row) 
        {
            array_push($categorias_ids, $this->chat->get_category_id($row)['id']);
        }

        //print_r ($categorias_ids);
        //echo var_dump($categorias_ids);


        //Preguntas de cada ejercicio
        $datos['disordered_questions'] = $this->chat->get_disordered_questions(7, $categorias_ids);
        $datos['tf_questions'] = $this->chat->get_tf_questions(8, $categorias_ids);
        $datos['audio_questions'] = $this->chat->get_audio_questions(3, $categorias_ids);
        $datos['question_answer'] = $this->chat->get_questions(3, $categorias_ids);


        
        $datos['num_preguntas'] = count($datos['disordered_questions']) + count($datos['tf_questions']) + count($datos['audio_questions']) + count($datos['question_answer']);
        
        
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        $this->load->view('final_test_exam', $datos);
    }


    //HACIENDO
    public function final_test_try_again($id_exam)
    {
        $titulo['titulo'] = "Final test exam"; 

        if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'main/login/');
        }

        // Obtiene todas las preguntas que ha fallado el alumno en el examen con el id dado($id_exam)
        $result = $this->chat->get_try_again_questions($id_exam); 


        // Se crean 4 arrays para almacenar cada tipo de pregunta
        $type_1 = array(); //question and answer questions
        $type_2 = array(); //disordered questions
        $type_3 = array(); //true false questions
        $type_4 = array(); //audio questions
        $type_1_ids = array();
        $type_2_ids = array();
        $type_3_ids = array();
        $type_4_ids = array();

        // Se itera sobre las preguntas obtenidas y según el tipo de cada una se almacena en uno de los arrays
        foreach ($result as $row)
        {   
            switch ($row['id_type_question']) 
            {
                case 1:
                    array_push($type_1, $row);
                    array_push($type_1_ids, $row['id_question']);
                    break;
                case 2:
                    array_push($type_2, $row);
                    array_push($type_2_ids, $row['id_question']);
                    break;
                case 3:
                    array_push($type_3, $row);
                    array_push($type_3_ids, $row['id_question']);
                    break;
                case 4:
                    array_push($type_4, $row);
                    array_push($type_4_ids, $row['id_question']);
                    break;
            }
        }
        

        /* Se le resta al numero de preguntas definidas de cada tipo para el examen, las preguntas que 
        ha fallado el alumno, así solo hará falta obtener el resto de preguntas de cada tipo de la BD
        */ 
        $num_questions_type_1 = 3 - count($type_1);
        $num_questions_type_2 = 3 - count($type_2);
        $num_questions_type_3 = 3 - count($type_3);
        $num_questions_type_4 = 3 - count($type_4);


        //Enunciados de todos los tipos de ejercicios
        $datos['enun_disordered'] = $this->enun_disordered;
        $datos['enun_tf'] = $this->enun_tf;
        $datos['enun_audio_write'] = $this->enun_audio_write;
        $datos['enun_question_3answers'] = $this->enun_question_3answers;
        $datos['enun_question_tf_answer'] = $this->enun_question_tf_answer;
        $datos['enun_q_a'] = $this->enun_q_a;

        //Preguntas de cada ejercicio
        $datos['disordered_questions'] = $this->chat->get_disordered_questions($num_questions_type_2, $type_2_ids);
        $datos['tf_questions'] = $this->chat->get_tf_questions($num_questions_type_3,$type_3_ids);
        $datos['audio_questions'] = $this->chat->get_audio_questions($num_questions_type_4,$type_4_ids);
        $datos['question_answer'] = $this->chat->get_questions($num_questions_type_1,$type_1_ids);
        $d1_ids = array();
        $d2_ids = array();
        $d3_ids = array();
        $d4_ids = array();
        $d2_ids = $this->chat->get_disordered_questions_by_ids($type_2_ids);
        $d3_ids = $this->chat->get_tf_questions_by_ids($type_3_ids);
        $d4_ids = $this->chat->get_audio_questions_by_ids($type_4_ids);
        $d1_ids = $this->chat->get_questions_by_ids($type_1_ids);



        if($d2_ids != null)
            $datos['disordered_questions'] = array_merge($datos['disordered_questions'], $d2_ids);
        if($d3_ids != null)
            $datos['tf_questions'] = array_merge($datos['tf_questions'], $d3_ids);
        if($d4_ids != null)
            $datos['audio_questions'] = array_merge($datos['audio_questions'], $d4_ids);
        if($d1_ids != null)
            $datos['question_answer'] = array_merge($datos['question_answer'], $d1_ids);



        
        //Si no hay preguntas muestra un error;
        if($datos['disordered_questions'] == null && $datos['tf_questions'] == null)
        {   
            echo "error con las preguntas.";
        }
        else
        {
            $datos['num_preguntas'] = count($datos['disordered_questions']) + count($datos['tf_questions']) + count($datos['audio_questions']) + count($datos['question_answer']);
        }
        
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        $this->load->view('final_test_exam', $datos);
        
    }

    //Esto se usa cuando en los resultados se quiere repetir un examen ya hecho
    public function repeat_final_test($id_exam)
    {
        if(empty($this->session->userdata['email']))
        {
             redirect(site_url().'main/login/');
        }

        //Enunciados de cada ejercicio
        $data['enun_disordered'] = $this->enun_disordered;
        $data['enun_tf'] = $this->enun_tf;
        $data['enun_audio_write'] = $this->enun_audio_write;
        $data['enun_question_3answers'] = $this->enun_question_3answers;
        $data['enun_question_tf_answer'] = $this->enun_question_tf_answer;
        $data['enun_q_a'] = $this->enun_q_a;

        $info_exam = $this->result->get_exam_info($id_exam); //obtiene el examen

        //$data['correct'] = $info_exam->right;
        $data['num_preguntas'] = $info_exam->num_questions;

        $data['disordered_questions'] = $this->chat->get_disordered_results($id_exam); //obtiene todas las entries
        $data['tf_questions'] = $this->chat->get_truefalse_results($id_exam); //obtiene todas las entries
        $data['audio_questions'] = $this->chat->get_audiowrite_results($id_exam); //obtiene todas las entries
        $data['question_answer'] = $this->chat->get_q_a_results($id_exam); //obtiene todas las entries

        $data['num_disordered'] = count($data['disordered_questions']);
        $data['num_truefalse'] = count($data['tf_questions']);
        $data['num_audiowrite'] = count($data['audio_questions']);
        $data['num_q_a'] = count($data['question_answer']);

        $titulo['titulo'] = "Test Results"; 
        
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        $this->load->view('final_test_exam', $data);

    }

    
    public function resultdisplay_final() 
    {
        if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'main/login/');
        }
        
        $this->data['enun_disordered'] = $this->enun_disordered;
        $this->data['enun_tf'] = $this->enun_tf;
        $this->data['enun_audio_write'] = $this->enun_audio_write;

        $id_exam =$this->chat->create_final_exam();
        $num_preguntas = $this->input->post('cantidad');
        $likert_scale = $this->input->post('optradio');

        $correctas = 0;
        $incorrectas = 0;
        $desordenadas = 0;
        $true_false = 0;
        $audio = 0;
        $question_answer = 0;
        //$question_3answer = 0;

        $this->data['disordered_questions'] = array(); //Array para almacenar todas las preguntas
        $this->data['truefalse_questions'] = array(); //Array para almacenar todas las preguntas
        $this->data['audio_questions'] = array(); //Array para almacenar todas las preguntas

        $this->data['questions'] = array(); //Array para almacenar todas las preguntas

        $this->data['examples_answers'] = array();  //Array para almacenar las respuestas ejeplos para los resultados


        for($i=1; $i<$num_preguntas+1; $i++)  //Comprueba cuantas son correctas e incorrectas y crea los entries
        {

            if($this->input->post('type'.$i.'') == 'disordered')
            {   
                $desordenadas++;
                //respuesta dada
                $post = $this->input->post('quizid'.$i.''); 
                //id de la pregunta
                $id = $this->input->post('id'.$i.''); 


                array_push($this->data['disordered_questions'], $this->chat->get_disordered_byid($id));

                if(correct_disordered($id, $post, $id_exam))
                {
                    $correctas++;
                }
                else
                {
                    $incorrectas++;
                }

            }
            if($this->input->post('type'.$i.'') == 'truefalse')
            {
                $true_false++;
                //respuesta dada
                $post = $this->input->post('quizid'.$i.''); 
                //id de la pregunta
                $id = $this->input->post('id'.$i.''); 

                array_push($this->data['truefalse_questions'], $this->chat->get_truefalse_byid($id));

                if(correct_truefalse($id, $post, $id_exam))
                {
                    $correctas++;
                }
                else
                {
                    $incorrectas++;
                }
            }

            if($this->input->post('type'.$i.'') == 'audio_write')
            {
                $audio++;
                $post = $this->input->post('quizid'.$i.''); //respuesta dada
               
                $id = $this->input->post('id'.$i.'');  //id de la pregunta

                array_push($this->data['audio_questions'], $this->chat->get_question_byid($id)); //Busca en la BD la pregunta por el id y almacena todos los campos de esta pregunta en el array

               if(correct_audioquestions($id, $post, $id_exam))
                {
                    $correctas++;
                }
                else
                {
                    $incorrectas++;
                }
            }

            if($this->input->post('type'.$i.'') == 'question_answer')
            {   
                $question_answer++;

                $respuesta_dada = $this->input->post('quizid'.$i.''); //respuesta dada
                $id = $this->input->post('id'.$i.''); //id de la pregunta

                array_push($this->data['questions'], $this->chat->get_question_byid($id)); //Busca en la BD la pregunta por el id y almacena todos los campos de esta pregunta en el array
                
                if(correct_variablequestions($id, $id_exam, $respuesta_dada))
                {
                    $correctas++;
                }
                else
                {
                    $incorrectas++;
                }   
            }
        }
        

        $this->chat->update_exam($id_exam, $correctas, $num_preguntas, $likert_scale);

        $this->data['num_questions'] = $num_preguntas;
        $this->data['desordenadas'] = $desordenadas;
        $this->data['true_false'] = $true_false;
        $this->data['audio'] = $audio;
        $this->data['question_answer'] = $question_answer;

        //$this->data['true_false'] = $true_false;
        //$this->data['question_3answer'] = $TRUE_FALSE;

        $this->data['id_examen'] =  $id_exam;
        $this->data['respuestas'] = $this->chat->get_entries_respuestas($id_exam);
        $this->data['correct'] =  $correctas;

     
        $titulo['titulo'] = "Final test exam"; 
        
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        $this->load->view('result_display_finaltest', $this->data);  
        
    }
    

    //creo que no se usa
    public function comprobar()
    {   
        $titulo['titulo'] = "Result"; 
       
        $this->load->view('header', $titulo);
        
        $correctas = 0;
        $incorrectas = 0;

        for($i=1; $i<2; $i++)
        {
            $post = $this->input->post('userInput'.$i.''); 
            echo $post; 
           
            $this->db->get_where('answer', array('disordered_statement' => $post,'id_question'=>$this->input->post('questionid'.$i.'')), 1);
            
            if($this->db->affected_rows() > 0)
            {
                $correctas = $correctas + 1;
            }else
                $incorrectas = $incorrectas + 1;
        }

        $this->load->view('result_display_finaltest');
         
        echo '<div class=" center">Correctas: '.$correctas.'</div>';
        echo '<div class=" center">Incorrectas: '.$incorrectas.'</div>';  
    }


              
        
}
