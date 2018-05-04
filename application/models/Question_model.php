<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_model extends CI_Model {

	//Datatables configuration
	var $table = 'question';
	var $column_order = array('statement','id_category',null); //set column field database for datatable orderable
	var $column_search = array('statement','id_category'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
     * Realiza el update de una pregunta
     *
     * @return number con el numero de 
     * @param string $where id de la pregunta
     * @param string $data nueva pregunta
    */ 
	public function update($where, $data)
	{
		$this->db->update('question', $data, $where);

		return $this->db->affected_rows();
	}

	/**
     * Realiza el update de una respuesta
     *
     * @return number con el numero de 
     * @param string $where id de la respuesta
     * @param string $data nueva pregunta
    */ 
	public function update_answer($where, $data)
	{
		$this->db->where('id', $where);
		$this->db->update('answer', $data); 

		return $this->db->affected_rows();
	}

	
	/**
     * Elimina un audio dado el id de la pregunta
     *
     * @param string $id id de la pregunta
    */ 
	public function delete_audio_by_id($id)
	{
		$data = array(
               'audio' => NULL,
            	);

		$this->db->where('id', $id);
		$this->db->update('question', $data); 
	}

	/**
     * Elimina una respuesta dado su id
     *
     * @param string $id id de la pregunta
    */ 
	public function delete_answer_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('answer');
	}

	/**
     * Elimina una pregunta dado su id
     *
     * @param string $id id de la pregunta
    */ 
	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

	/**
     * Elimina el nombre de un audio de la bd dado el id de la pregunta
     *
     * @return boolean true si el delete se ha realizado correctamente
     * @param string $id id de la pregunta
    */  
	public function delete_audio_name($id)
	{
		$data = array(
               'audio' => NULL,
            );

		$this->db->where('id', $id);
		$this->db->update('question', $data); 
	}

	/**
     * Devuelve el nombre de la categoria dado el id de la pregunta
     *
     * @return object con el nombre de la categoria
     * @param string $id id de la pregunta
    */ 
	public function get_category_by_id($id)
	{
		$this->db->select('description');
		$this->db->from('category');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	/**
     * Devuelve el nombre de la pregunta cuyo id conincide con el dado
     *
     * @return object con el nombre de la pregunta
     * @param string $id id de la pregunta
    */ 
	public function get_question_name($id)
	{
		$this->db->select('statement');
		$this->db->from('question');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	/**
     * Devuelve el numero de la categoria cuyo id conincide con el dado
     *
     * @return object con el numero de la categoria
     * @param string $id id de la categoria
    */ 
	public function get_category_number($element)
	{
		$this->db->select('number');
		$this->db->from('category');
		$this->db->where('id',$element);
		$query = $this->db->get();

		return $query->row();
	}

	/**
     * Devuelve todas las respuestas de una pregunta dado el id de la pregunta
     *
     * @return array con las respuestas
     * @param string $id id de la pregunta
    */ 
	public function get_answers_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('answer');
		$this->db->where('id_question',$id);
		$query = $this->db->get();

		return $query->result_array();
	}

	/**
     * Recibe el id de una pregunta y devuelve sus datos
     *
     * @return array con los datos de la pregunta
     * @param string $id id de la pregunta
    */ 
	public function edit($id)
	{
		$this->db->select('question.id,question.statement,question.id_category,answer.answer');
		$this->db->from('question');
		$this->db->where('question.id',$id);
		$this->db->join('answer','answer.id_question=question.id');

		$query=$this->db->get();
		$data=$query->result_array();

		return $data;
	}

	/**
     * Inserta el nombre del audio en la BD 
     *
    */ 
	public function insert_audio($idquestion, $filename)
	{
		$this->db->where('id', $idquestion);
		$this->db->update('question', $filename);
	}

	/**
     * Inserta una nueva respuesta
     *
     * @param string $data con los datos de la respuesta
    */ 
	public function insert_answer($data)
	{
		$this->db->insert('answer', $data);
	}

	/**
     * Devuelve el nombre del audio con la extension dado el id de la pregunta
     *
     * @return object con el nombre del audio
     * @param string $id id de la pregunta a la que pertenece el audio
    */ 
	public function get_audio_name($id_question)
	{

		$this->db->select('audio');
		$this->db->from('question');
		$this->db->where('id',$id_question);
		$query = $this->db->get();

		return $query->row()->audio;
	}

	/*************************** DATATABLES FUNCTIONS *****************************/

	private function _get_datatables_query()
	{
		$this->db->from('question');

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query('question');
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query('question');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	/*************************** END DATATABLES FUNCTIONS *****************************/

}
