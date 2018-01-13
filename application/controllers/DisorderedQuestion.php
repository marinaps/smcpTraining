<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DisorderedQuestion extends CI_Controller {

	public $status; 
    public $roles;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('disorderedquestion_model','disorderedquestion');
		$this->status = $this->config->item('status'); 
        $this->roles = $this->config->item('roles');
        $this->load->helper('category_helper');
	}

 	/**
     * Metodo index que muestra la vista de las preguntas desordenadas
     * 
    */  
	public function index()
	{
		if(empty($this->session->userdata['email']))
		{
            redirect(site_url().'/main/login/');
        }            

        $titulo['titulo'] = "Disordered Question menu"; 
        
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        $this->load->view('question_disordered_view');
	}


	/**
     * Metodo que muestra la tabla con las preguntas
     *
    */  
	public function ajax_list()
	{
		$list = $this->disorderedquestion->get_datatables();

		$data = array();
		$no = $_POST['start'];

		foreach ($list as $question) 
		{
			$no++;
			$row = array();
			
			$row[] = $question->ordered;
			$row[] = $question->disordered;
			$row[] = $this->disorderedquestion->get_number($question->id_category)->number." ".$this->disorderedquestion->get_description($question->id_category)->description;
		
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_question('."'".$question->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_question('."'".$question->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
 
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->disorderedquestion->count_all(),
						"recordsFiltered" => $this->disorderedquestion->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}


	/**
     * Recibe el id de una pregunta y devuelve sus datos
     *
     * @return array con los datos de la pregunta
     * @param string $id con el id de la pregunta
    */  
	public function ajax_edit($id)
	{
		$data = $this->disorderedquestion->edit($id);
		echo json_encode($data);
	}


	/**
     * Añade una nueva pregunta 
     *
     * @return boolean true si el add se ha realizado correctamente
    */  
	public function ajax_add() 
	{
		$this->_validate();
		$data = array(
				'ordered' => $this->input->post('ordered'),
				'disordered' => $this->input->post('disordered'),
				'id_category' => $this->input->post('id_category'),		
			);
		
		$this->db->insert('disordered_statement', $data);
		$afftectedRows = $this->db->affected_rows();
		if($afftectedRows > 0)
			$this->disorderedquestion->addquestions($data['id_category'], $afftectedRows);

		echo json_encode(array("status" => TRUE));
	}


	/**
     * Realiza el update de una pregunta
     *
     * @return boolean true si el update se ha realizado correctamente
    */  
	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'ordered' => $this->input->post('ordered'),
				'disordered' => $this->input->post('disordered'),
				'id_category' => $this->input->post('id_category')
					
			);
		$this->disorderedquestion->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	/**
     * Elimina una pregunta dado el id
     *
     * @return boolean true si el delete se ha realizado correctamente
     * @param string $id id de la pregunta
    */  
	public function ajax_delete($id)
	{
		$categoryid = $this->disorderedquestion->get_id_category($id);
		$this->disorderedquestion->delete_by_id($id);
		$afftectedRows = $this->db->affected_rows();
		if($afftectedRows > 0)
			$this->disorderedquestion->deletequestions($categoryid, $afftectedRows);
		echo json_encode(array("status" => TRUE));
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

		if($this->input->post('ordered') == '')
		{
			$data['inputerror'][] = 'ordered';
			$data['error_string'][] = 'The ordered question is required';
			$data['status'] = FALSE;
		}

		
		if($this->input->post('disordered') == '')
		{
			$data['inputerror'][] = 'disordered';
			$data['error_string'][] = 'The disordered question is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('id_category') == '')
		{
			$data['inputerror'][] = 'id_category';
			$data['error_string'][] = 'The category is required';
			$data['status'] = FALSE;
		}


		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
