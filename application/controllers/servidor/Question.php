<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {

	public $status; 
    public $roles;
     //var $table_answer = 'answer';
     //var $table= 'question';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('question_model','question');
		$this->status = $this->config->item('status'); 
        $this->roles = $this->config->item('roles');
	}

	public function index()
	{
		if(empty($this->session->userdata['email'])){
                redirect(site_url().'/main/login/');
            }            

            $titulo['titulo'] = "Question menu"; 
            /*front page*/
            $data = $this->session->userdata; 
            $this->load->view('header', $titulo);
            $this->load->view('navbar');
            $this->load->view('question_menu');
	}

	public function questions()
	{
		if(empty($this->session->userdata['email'])){
                redirect(site_url().'/main/login/');
            }            

            $titulo['titulo'] = "Questions"; 
            /*front page*/
            $data = $this->session->userdata; 
            $this->load->view('header', $titulo);
            $this->load->view('navbar');
            $this->load->view('question_view');



	}

	
	public function ajax_list()
	{
		$list = $this->question->get_datatables();

		$data = array();
		$no = $_POST['start'];
		foreach ($list as $question) {
			$no++;
			$row = array();
			
			//$row[] = $question->id_category;
			$row[] = $question->statement;

			$row[] = $this->question->get_number($question->id_category)->number;
			$row[] = $this->question->get_description($question->id_category)->description;

			//$respuestas = $this->question->get_answer_by_id($question)->id;
			//$row[] = $this->question->get_answer_by_id($question->id)->answer;

			//<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Hapus" onclick="enviar_formulario('."'".$question->id."'".')">ansers</a>';
			
			//add html for action
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

	public function ajax_edit($id)
	{
		$data = $this->question->prueba($id);
		echo json_encode($data);
	}

	public function ajax_get_category()
	{
		$this->db->select('*');
		$this->db->from('category');
		$query = $this->db->get();

		return $query->row();
	}



	public function ajax_add() //REVISAR -> MODIFICAR
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


		$link = mysqli_connect("localhost","smcp-training","smcptr41n1g274");
		mysqli_select_db($link, "smcp_training");

		if (isset($_POST['nombre']))
		{

			$nombre = $_POST['nombre'];
				   
			$i = 0;

				if (mysqli_connect_errno())
				  {
				  echo "Failed to connect to MySQL: " . mysqli_connect_error();
				  }

			    foreach($nombre as $n) {  

			       $name = $nombre[$i];
			       $sql = "INSERT INTO answer (answer, id_question) VALUES ('$name', '$idquestion')";
			       mysqli_query($link, $sql);
			      
			        $i++;
			    }
				   
		 }
		  echo json_encode(array("status" => TRUE));
}


	

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'statement' => $this->input->post('statement'),
				'id_category' => $this->input->post('id_category'),
					
			);
		$this->question->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->question->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


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


		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
