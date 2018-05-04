<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Answer extends CI_Controller {

	public $status; 
    public $roles;
  	var $table_answer = 'answer';
    var $table= 'question';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('answer_model','answer');
		$this->status = $this->config->item('status'); 
        $this->roles = $this->config->item('roles');
	}

	/**
     * Metodo index que muestra la vista de las respuestas
     *
    */  
	public function index()
	{
		if(empty($this->session->userdata['email']))
		{
            redirect(site_url().'main/login/');
        }            

        $titulo['titulo'] = "Anwsers"; 
        /*front page*/
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        $this->load->view('answer_view');
	}

	/**
     * Metodo que muestra la tabla de respuestas
     *
    */  
	public function ajax_list()
	{
		$list = $this->answer->get_datatables();

		$data = array();
		$no = $_POST['start'];
		foreach ($list as $answer) 
		{
			$no++;
			$row = array();
			
			$row[] = $answer->answer;
			$row[] = $this->answer->get_question_by_id($answer->id_question)->statement;

			//Añade html para los botones de editar y borrar
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_answer('."'".$answer->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_answer('."'".$answer->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->answer->count_all(),
						"recordsFiltered" => $this->answer->count_filtered(),
						"data" => $data,
					);

		//Devuelve un array en formato json
		echo json_encode($output);
	}

	/**
     * Recibe el id de una respuesta y devuelve sus datos
     *
     * @return array con los datos de la respuesta
     * @param string $id id de la respuesta
    */  
	public function ajax_edit($id)
	{
		$data = $this->answer->get_answer_by_id($id);

		echo json_encode($data);
	}
	
	/**
     * Realiza el update de una respuesta
     *
     * @return boolean true si el update se ha realizado correctamente
    */  
	public function ajax_update()
	{
		$data = array(
				'answer' => $this->input->post('answer'),		
			);
		$this->answer->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	/**
     * Elimina una respuesta dado el id
     *
     * @return boolean true si el delete se ha realizado correctamente
     * @param string $id id de la respuesta
    */  
	public function ajax_delete($id)
	{
		$this->answer->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

}
