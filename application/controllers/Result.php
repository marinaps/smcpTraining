<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Result extends CI_Controller {

	public $status; 
    public $roles;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('result_model','result');
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
     * Metodo index que muestra el menu de los resultados de los alumnos(training mode y final test mode)
     *
    */ 
	public function index()
	{
		if(empty($this->session->userdata['email']))
		{
             redirect(site_url().'main/login/');
        }

        $data['titulo'] = "Results Menu"; 
		
		$this->load->view('header', $data);
		$this->load->view('navbar');
		$this->load->view('result_mode_menu');
	}


	/**
     * Muestra la vista con los resultados del modo training
     *
    */
	public function training_mode()
	{
		if(empty($this->session->userdata['email']))
		{
             redirect(site_url().'main/login/');
        }

        $data['titulo'] = "Training Results"; 
		
		$this->load->view('header', $data);
		$this->load->view('navbar');
		$this->load->view('result_training_level_view');
	}

	/**
     * Muestra la vista con los resultados del modo training para el pattern level
     *
    */
	public function pattern_level_results()
	{
		if(empty($this->session->userdata['email']))
		{
             redirect(site_url().'main/login/');
        }

        $data['titulo'] = "Training Results"; 
		
		$this->load->view('header', $data);
		$this->load->view('navbar');

		if($this->session->userdata['role'] == "1")
			$this->load->view('pattern_level_results_view');
		else
			$this->load->view('pattern_level_results_view_student');
	}

	/**
     * Muestra la vista con los resultados del modo training para el pattern level
     *
    */
	public function association_level_results()
	{
		if(empty($this->session->userdata['email']))
		{
             redirect(site_url().'main/login/');
        }

        $data['titulo'] = "Training Results"; 
		
		$this->load->view('header', $data);
		$this->load->view('navbar');

		if($this->session->userdata['role'] == "1")
			$this->load->view('association_level_results_view');
		else
			$this->load->view('association_level_results_view_student');
	}

	/**
     * Muestra la vista con los resultados del modo final test
     *
    */
	public function final_test_mode()
	{
		if(empty($this->session->userdata['email']))
		{
             redirect(site_url().'main/login/');
        }

        $data['titulo'] = "Final Test Results"; 
		
		$this->load->view('header', $data);
		$this->load->view('navbar');

		if($this->session->userdata['role'] == "1")
			$this->load->view('result_final_view');
		else
			$this->load->view('result_final_view_student');
	}


	/**
     * Muestra la tabla con los resultados de los alumnos del modo training del nivel pattern
     *
    */
	public function ajax_list_pattern()
	{
		$list = $this->result->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) 
		{
			$no++;
			$row = array();
			$row[] = $this->result->get_name($person->id_user)->first_name;
			$row[] = $this->result->get_lastname($person->id_user)->last_name;
			$row[] = $person->date;
			$row[] = $person->right."/".$person->num_questions;
			//Si es un administrador muestra la columna de LIKERT, si es un alumno entonces no la muestra.
			if($this->session->userdata['role'] == "1") 
				$row[] = $person->likert;	
		
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="see_results('."'".$person->id."'".')"><i class="glyphicon glyphicon-eye-open"></i> See test</a>';

			$data[] = $row;
		}

		$output = array(
							"draw" => $_POST['draw'],
							"recordsTotal" => $this->result->count_all("pattern"),
							"recordsFiltered" => $this->result->count_filtered("pattern"),
							"data" => $data,
						);
		//output to json format
		echo json_encode($output);
	}

	/**
     * Muestra la tabla con los resultados de los alumnos del modo training del nivel association
     *
    */
	public function ajax_list_association()
	{
		$list = $this->result->get_datatables_association();

		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) 
		{
			$no++;
			$row = array();
			$row[] = $this->result->get_name($person->id_user)->first_name;
			$row[] = $this->result->get_lastname($person->id_user)->last_name;
			$row[] = $person->date;
			$row[] = $person->right."/".$person->num_questions;
			//Si es un administrador muestra la columna de LIKERT, si es un alumno entonces no la muestra.
			if($this->session->userdata['role'] == "1") 
			$row[] = $person->likert;	
		
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="see_results('."'".$person->id."'".')"><i class="glyphicon glyphicon-eye-open"></i> See test</a>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->result->count_all("association"),
						"recordsFiltered" => $this->result->count_filtered("association"),
						"data" => $data,
						);
		//output to json format
		echo json_encode($output);
	}


	/**
     * Muestra la tabla con los resultados de los alumnos del modo final test
     *
    */
	public function ajax_list_final()
	{
		$list = $this->result->get_datatables_final();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) 
		{
			$no++;
			$row = array();
			$row[] = $this->result->get_name($person->id_user)->first_name;
			$row[] = $this->result->get_lastname($person->id_user)->last_name;
			$row[] = $person->date;
			$row[] = $person->right."/".$person->num_questions;
			//Si es un administrador muestra la columna de LIKERT, si es un alumno entonces no la muestra.
			if($this->session->userdata['role'] == "1") 
			$row[] = $person->likert;	
		

			if($this->session->userdata['id'] == $person->id_user)
			{
				//add html for action
				$row[] = '<a style="margin-top: 5px;" class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="see_results('."'".$person->id."'".')"><i class="glyphicon glyphicon-eye-open"></i> See test</a> <a style="margin-top: 5px;" class="btn btn-sm btn-primary" href="javascript:void(0)" title="Repeat" onclick="repeat_exam('."'".$person->id."'".')"><i class="glyphicon glyphicon-repeat"></i> Repeat test</a>';
			}
			else
			{
				//add html for action
				$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="see_results('."'".$person->id."'".')"><i class="glyphicon glyphicon-eye-open"></i> See test</a>';
			}

			$data[] = $row;
		}

		$output = array(
							"draw" => $_POST['draw'],
							"recordsTotal" => $this->result->count_all("final"),
							"recordsFiltered" => $this->result->count_filtered("final"),
							"data" => $data,
						);
		//output to json format
		echo json_encode($output);
	}
 


 	/**
     * Muestra los resultados de un examen determinado del training mode del pattern level dado el id del examen
     *
     * @param string $id_exam id del examen
    */
	public function display_pattern_results($id_exam)
	{
		if(empty($this->session->userdata['email']))
		{
             redirect(site_url().'main/login/');
        }
        //Enunciados de cada ejercicio
        $data['enun_disordered'] = $this->enun_disordered;
        $data['enun_tf'] = $this->enun_tf;
        $data['enun_audio_write'] = $this->enun_audio_write;

        $info_exam = $this->result->get_exam_info($id_exam); //obtiene el examen

        $data['correct'] = $info_exam->right;
        $data['num_questions'] = $info_exam->num_questions;
        
        if(isset($info_exam->category))
        {
        	$data['category'] = $this->result->get_category_name($info_exam->category);
		}

        $data['results_disordered'] = $this->result->get_disordered_results($id_exam); //obtiene todas las entries
        $data['results_truefalse'] = $this->result->get_truefalse_results($id_exam); //obtiene todas las entries
        $data['results_audiowrite'] = $this->result->get_audiowrite_results($id_exam); //obtiene todas las entries

        $data['num_disordered'] = count($data['results_disordered']);
        $data['num_truefalse'] = count($data['results_truefalse']);
        $data['num_audiowrite'] = count($data['results_audiowrite']);

        $titulo['titulo'] = "Test Results"; 
		
		$this->load->view('header', $titulo);
		$this->load->view('navbar');
		$this->load->view('pattern_review_results_view', $data);
	}

	/**
     * Muestra los resultados de un examen determinado del training mode del association level dado el id del examen
     *
     * @param string $id_exam id del examen
    */
	public function display_association_results($id_exam=NULL)
	{
		if(empty($this->session->userdata['email']))
		{
             redirect(site_url().'main/login/');
        }

        //Enunciados
        $data['enun_question_3answers'] = $this->enun_question_3answers;
        $data['enun_question_tf_answer'] = $this->enun_question_tf_answer;
        $data['enun_q_a'] = $this->enun_q_a;


        $info_exam = $this->result->get_exam_info($id_exam); //obtiene el examen
        $data['correct'] = $info_exam->right;
        $data['num_questions'] = $info_exam->num_questions;

        if(isset($info_exam->category))
        {
        	$data['category'] = $this->result->get_category_name($info_exam->category);
		}

        $data['results_questions'] = $this->result->get_q_a_results($id_exam); //obtiene todas las entries
        //$data['results_truefalse'] = $this->result->get_truefalse_results($id_exam); //obtiene todas las entries
        //$data['results_audiowrite'] = $this->result->get_audiowrite_results($id_exam); //obtiene todas las entries

        $data['correct_answers'] = array(); //Array para almacenar todas las respuestas correctas

        foreach($data['results_questions'] as $valor)
        {	
        	 $correct_answer = $this->result->get_one_correct_answer($valor->id_question); 

        	 if(strpos($correct_answer['answer'], '$'))
                {
                    $porciones = explode("$", $correct_answer['answer']);
                    $num = count($porciones); //tamaño del array porciones

                    for ($j = 0; $j < $num; $j++) 
                    {   
                        if($j%2 != 0)
                        {   
                            $id_type_variable = $this->result->get_id_type_variable($porciones[$j]);
                            $variable_example = $this->result->get_variable_example($id_type_variable->id);

                            $correct_answer['answer'] = str_replace("$".$porciones[$j]."$", $variable_example->name, $correct_answer['answer']);                            
                        }
                    }
                    $data['correct_answers'][] =  $correct_answer;
                }
                else
                {
                    $data['correct_answers'][] =  $correct_answer;
                }

        }
        
        $data['num_q_a'] = count($data['results_questions']);
        //$data['num_truefalse'] = count($data['results_truefalse']);
        //$data['num_audiowrite'] = count($data['results_audiowrite']);

        $titulo['titulo'] = "Test Results"; 
		
		$this->load->view('header', $titulo);
		$this->load->view('navbar');
		if($id_exam)
		$this->load->view('association_review_results_view', $data);
		else
		$this->load->view('errors/html/error_general');
	}

	/**
     * Muestra los resultados de un examen determinado del final test mode
     *
    */
	public function display_results_final($id_exam)
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

        $data['correct'] = $info_exam->right;
        $data['num_questions'] = $info_exam->num_questions;

        $data['results_disordered'] = $this->result->get_disordered_results($id_exam); //obtiene todas las entries
        $data['results_truefalse'] = $this->result->get_truefalse_results($id_exam); //obtiene todas las entries
        $data['results_audiowrite'] = $this->result->get_audiowrite_results($id_exam); //obtiene todas las entries
        $data['results_questions'] = $this->result->get_q_a_results($id_exam); //obtiene todas las entries

        $data['correct_answers'] = array(); //Array para almacenar todas las respuestas correctas

        foreach($data['results_questions'] as $valor)
        {	
        	 $correct_answer = $this->result->get_one_correct_answer($valor->id_question); 

        	 if(strpos($correct_answer['answer'], '$'))
                {
                    $porciones = explode("$", $correct_answer['answer']);
                    $num = count($porciones); //tamaño del array porciones

                    for ($j = 0; $j < $num; $j++) 
                    {   
                        if($j%2 != 0)
                        {   
                            $id_type_variable = $this->result->get_id_type_variable($porciones[$j]);
                            $variable_example = $this->result->get_variable_example($id_type_variable->id);

                            $correct_answer['answer'] = str_replace("$".$porciones[$j]."$", $variable_example->name, $correct_answer['answer']);                            
                        }
                    }
                    $data['correct_answers'][] =  $correct_answer;
                }
                else
                {
                    $data['correct_answers'][] =  $correct_answer;
                }

        }

        $data['num_disordered'] = count($data['results_disordered']);
        $data['num_truefalse'] = count($data['results_truefalse']);
        $data['num_audiowrite'] = count($data['results_audiowrite']);
        $data['num_q_a'] = count($data['results_questions']);

        $titulo['titulo'] = "Test Results"; 
		
		$this->load->view('header', $titulo);
		$this->load->view('navbar');
		$this->load->view('final_review_results_view', $data);
	}
}
