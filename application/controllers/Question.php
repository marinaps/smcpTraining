<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {

	public $status; 
    public $roles;

	public function __construct()
	{
		parent::__construct();

        $this->load->library('form_validation');   
		$this->load->model('question_model','question');
		$this->status = $this->config->item('status'); 
        $this->roles = $this->config->item('roles');
	}

	/**
     * Metodo index que muestra el menu de administracion de preguntas
     * 
     * Muestra el menu con las preguntas, las preguntas desordenadas, las de v/F 
     * y las respuestas
    */  
	public function index()
	{
		if(empty($this->session->userdata['email']))
		{
            redirect(site_url().'main/login/');
        }            

        $titulo['titulo'] = "Question menu"; 
        /*front page*/
        
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        $this->load->view('question_menu');
	}

	/**
     * Metodo que muestra la vista de las preguntas(las que no son ni desordenadas ni de v/f)
     * 
    */  
	public function questions()
	{
		if(empty($this->session->userdata['email']))
		{
            redirect(site_url().'main/login/');
        }            

        $titulo['titulo'] = "Questions"; 
        $datos['error'] = "";
        /*front page*/
        $data = $this->session->userdata; 
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        $this->load->view('question_view', $datos);
	}

	
	/**
     * Metodo que muestra la tabla con las preguntas(las que no son ni desordenadas ni de v/f)
     *
    */  
	public function ajax_list()
	{
		$list = $this->question->get_datatables();

		if(empty($this->session->userdata['email']))
		{
            redirect(site_url().'main/login/');
        }    

		$data = array();
		$no = $_POST['start'];
		foreach ($list as $question) 
		{
			$path = $this->question->get_audio_name($question->id);
			$url= site_url()."audio_uploads/".$path;

			$no++;
			$row = array();
			
			//$row[] = $question->id_category;
			$row[] = $question->statement; //Muestra la pregunta

			$row[] = $this->question->get_number($question->id_category)->number." ".$this->question->get_description($question->id_category)->description; //Muestra el numero y el nombre de la categoria


			if(count($this->question->get_audio_name($question->id))) //Comprueba si tiene un fichero de audio
			{
				//Si lo tiene lo muestra
				$row[] ='<div> <audio controls="controls" height="30px">
					  <source src="'.$url.'" type="audio/ogg">
					  <source src="'.$url.'" type="audio/mpeg">
					Your browser does not support the audio element.
					</audio> 
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_audio('."'".$question->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a></div>';
			}else
			{
				//Si no lo tiene muestra este string
				$row[] = "No audio uploaded";
			}

			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="view_answers('."'".$question->id."'".')"><i class="glyphicon glyphicon-eye-open"></i> View answers</a>';
			//add html for action
			//Muestra los botones de accion
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_question('."'".$question->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_question('."'".$question->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->question->count_all(),
						"recordsFiltered" => $this->question->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}


	/**
     * Realiza el update de las respuestas
     *
     * @return boolean true si el add se ha realizado correctamente
     * @param string $idquestion id de la pregunta
    */  
	public function ajax_update_form() 
	{	
		$this->_validate_update();
		$data = array(
				'statement' => $this->input->post('statement_edit'),
				'id_category' => $this->input->post('id_category_edit'),
					
			);
		$this->question->update(array('id' => $this->input->post('id_edit')), $data);

		$datos['error'] = '';
		$idquestion = $this->input->post('id_edit');
		if(!empty($_FILES))
        {
        	
        	if(count($this->question->get_audio_name($idquestion))) //Comprueba si la pregunta tiene un audio asociado
			{
				$path = $this->question->get_audio_name($idquestion); //Si lo tiene obtiene el nombre del audio
				$url= "audio_uploads/".$path; //obtiene la ruta del archivo en el servidor
				$do = unlink($url);  //elimina el archivo
		 
				if($do != true)
				{
				 	echo "There was an error trying to delete the file<br />";
				}

				$this->question->delete_audio_name($idquestion);
			}
        	
            $config['upload_path'] = './audio_uploads/';
            $config['allowed_types'] = 'mp3';
            $config['max_size'] = '4048576';

            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $titulo['titulo'] = "Upload audio"; 
            $config['file_name'] = "questionid".$idquestion."_categoryid".$this->input->post('id_category_edit');

            $this->load->library('upload', $config);

            if ($this->upload->do_upload("file_edit")) 
            {
            	$extension = $this->_get_extension($_FILES['file_edit']['name']);
            	$audio = array(
					'audio' => $config['file_name'].'.'.$extension,	
				);
            	$this->question->insert_audio($idquestion, $audio);
                
            }else
            {
            	$datos['error'] = $this->upload->display_errors();
            }  
        }

		if (isset($_POST['nombre_edit']))
		{

			$nombre = $_POST['nombre_edit'];
				   
			$i = 0;

		    foreach($nombre as $n) 
		    {  
		       $name = $nombre[$i];
		       if($name != '')
		       {
		       		if($this->input->post('false-answer_edit'.$i) == true)
		       		{
		       			$data = array(
		       							'answer' => $name,
		       							'correct' => 0,
		       							'id_question' => $idquestion,
		       							);
		       			$this->question->insert_answer($data);
		       		}
		       		else
		       		{
		       			$data = array(
		       							'answer' => $name,
		       							'id_question' => $idquestion,
		       							);
		       			$this->question->insert_answer($data);
		       			
		       		}
		      	 
		       }
		       $i++;
		    }

		
	}

	if($datos['error'] != '')
        {	
	        
			echo json_encode(array("status" => 'error', "error" =>$datos['error']));
		}else
		{
			echo json_encode(array("status" => TRUE));
		}

	}



	/**
     * Añade una nueva pregunta con sus respuestas
     *
     * @return boolean true si el add se ha realizado correctamente
    */  
	public function ajax_add() 
	{
		$this->_validate();
		$data = array(
				'id_category' => $this->input->post('id_category'),
				'statement' => $this->input->post('statement'),	
			);
		
		$this->db->insert('question', $data);

		$idquestion = $this->db->insert_id();
		
		$answer = array(
				'id_question' => $idquestion,
				'answer' => $this->input->post('answer'),	
			);
		$this->db->insert('answer', $answer);


		if (isset($_POST['nombre']))
		{
			$nombre = $_POST['nombre'];
				   
			$i = 0;

		    foreach($nombre as $n) 
		    {  
		       $name = $nombre[$i];
		       if($name != '')
		       {
		       		if($this->input->post('false-answer'.$i) == true)
		       		{
		      	 		$data = array(
		       							'answer' => $name,
		       							'correct' => 0,
		       							'id_question' => $idquestion,
		       							);
		       			$this->question->insert_answer($data);
		       		}
		       		else
		       		{
		       			$data = array(
		       							'answer' => $name,
		       							'id_question' => $idquestion,
		       							);
		       			$this->question->insert_answer($data);
		       		}
		      	 
		       }
		       $i++;
		    }		   
		}

      	$datos['error'] = '';
        if(!empty($_FILES))
        {

            $config['upload_path'] = './audio_uploads/';
            $config['allowed_types'] = 'mp3';
            $config['max_size'] = '4048576';

            
            $titulo['titulo'] = "Upload audio"; 
            $config['file_name'] = "questionid".$idquestion."_categoryid".$this->input->post('id_category');

            $this->load->library('upload', $config);

            if ($this->upload->do_upload("file")) 
            {
            	$extension = $this->_get_extension($_FILES['file']['name']);
            	$audio = array(
					'audio' => $config['file_name'].'.'.$extension,	
				);
            	$this->question->insert_audio($idquestion, $audio);
                
            }else
            {
            	$datos['error'] = $this->upload->display_errors();
            }  
        }

        if($datos['error'] != '')
        {	
	        
			echo json_encode(array("status" => 'error', "error" =>$datos['error']));
		}else
		{
			echo json_encode(array("status" => TRUE ));

		}

	}

	
	/**
     * Elimina un audio dado el id de la pregunta
     *
     * @return boolean true si el delete se ha realizado correctamente
     * @param string $id id de la pregunta
    */  
	public function ajax_delete_audio($id)
	{
		$path = $this->question->get_audio_name($id); //Si lo tiene obtiene el nombre del audio
		$url= "audio_uploads/".$path; //obtiene la ruta del archivo en el servidor
		$do = unlink($url);  //elimina el archivo

	 
		if($do != true){
		 echo "There was an error trying to delete the file<br />";
		 }
		$this->question->delete_audio_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	/**
     * Elimina una respuesta dado el id 
     *
     * @return boolean true si el delete se ha realizado correctamente
     * @param string $id id de la respuesta
    */  
	public function ajax_delete_answer($id)
	{
		$this->question->delete_answer_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	/**
     * Elimina una pregunta dado el id y elimina el archivo de audio del servidor
     *
     * @return boolean true si el delete se ha realizado correctamente
     * @param string $id id de la pregunta
    */  
	public function ajax_delete($id)
	{
		if(count($this->question->get_audio_name($id))) //Comprueba si la pregunta tiene un audio asociado
		{
			$path = $this->question->get_audio_name($id); //Si lo tiene obtiene el nombre del audio
			$url= "audio_uploads/".$path; //obtiene la ruta del archivo en el servidor
			$do = unlink($url);  //elimina el archivo

		 
			if($do != true){
			 echo "There was an error trying to delete the file<br />";
			 }
		}
		$this->question->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}



	/**
     * Realiza el update de las respuestas
     *
     * @return boolean true si el update se ha realizado correctamente
    */  
	public function ajax_update_answers()
	{
		if (isset($_POST['nombree']))
		{
			$nombre = $_POST['nombree'];
				   
			$i = 0;

		    foreach($nombre as $n) 
		    {  
		       $name = $nombre[$i];
		       $id_answer = $this->input->post('id_answer'.$i);
		     	
		       if($name != '')
		       {
		       		if($this->input->post('false-answer'.$i) == true)
		       		{

		       			$data = array(
		       							'answer' => $name,
		       							'correct' => 0,
		       							);
		       			$this->question->update_answer($id_answer, $data);

		       		}
		       		else
		       		{
		       			$data = array(
		       							'answer' => $name,
		       							'correct' => 1,
		       							);
		       			$this->question->update_answer($id_answer, $data);
		    			
		       		}
		      	 
		       }
		       $i++;
		    }		   
		}

		echo json_encode(array("status" => TRUE));
	}


	/**
     * Recibe el id de una pregunta y devuelve todas sus respuestas
     *
     * @return array con los las respuestas 
     * @param string $id id de la pregunta
    */  
	public function ajax_view_answers($id)
	{
		$data = $this->question->get_answers($id);
		$num = count($data);

		$name = $this->question->get_question_name($id);

		$variable = array( 'variable1' => $data, 
                       'variable2' => $num,
                       'variable3' => $id,
                       'variable4' =>  $name
                       );
		echo json_encode($variable);
	}


	/**
     * Recibe el id de una pregunta y devuelve sus datos
     *
     * @return array con los datos de la pregunta
     * @param string $id con el id de la pregunta
    */  
	public function ajax_edit($id)
	{
		$data = $this->question->edit($id);
		echo json_encode($data);
	}

	/**
     * Devuelve la extension de un archivo dado
     *
     * @return string con la extension del archivo
    */ 
	private function _get_extension($filename)
	{
		$tmp = explode(".", $filename);
		return end($tmp); 
	}

	/**
     * Valida los campos del input y devuelve los errores cuando se añade un campo
     *
     * @return array con los datos del error
    */ 
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('statement') == '')
		{
			$data['inputerror'][] = 'statement';
			$data['error_string'][] = 'Statement is required';
			$data['status'] = FALSE;
		}

		
		if($this->input->post('answer') == '')
		{
			$data['inputerror'][] = 'answer';
			$data['error_string'][] = 'The Answer is required';
			$data['status'] = FALSE;
		}

		
		if($this->input->post('id_category') == '')
		{
			$data['inputerror'][] = 'id_category';
			$data['error_string'][] = 'The category is required';
			$data['status'] = FALSE;
		}

		if(!empty($_FILES))
        {
            if( $_FILES['file']['type'] != 'audio/mpeg' && $_FILES['file']['type'] != 'audio/mp3')
            {
                $data['inputerror'][] = 'file';
                $data['error_string'][] = 'The file format is invalid or unsupported';
                $data['status'] = FALSE;
            }
        }

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	/**
     * Valida los campos del input y devuelve los errores cuando se edita un campo
     *
     * @return array con los datos del error
    */ 
	private function _validate_update()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('statement_edit') == '')
		{
			$data['inputerror'][] = 'statement_edit';
			$data['error_string'][] = 'Statement is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('id_category_edit') == '')
		{
			$data['inputerror'][] = 'id_category_edit';
			$data['error_string'][] = 'The category is required';
			$data['status'] = FALSE;
		}

		if(!empty($_FILES))
        {
            if( $_FILES['file_edit']['type'] != 'audio/mpeg' && $_FILES['file_edit']['type'] != 'audio/mp3')
            {
                $data['inputerror'][] = 'file_edit';
                $data['error_string'][] = 'The file format is invalid or unsupported';
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
