<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Answer_model extends CI_Model {

	//Datatables configuration
	var $column_order = array('answer','id',null); //set column field database for datatable orderable
	var $column_search = array('answer'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
     * Devuelve la respuesta cuyo id conincide con el dado
     *
     * @return object con la respuesta
     * @param string $id id de la respuesta
    */ 
	public function get_answer_by_id($id)
	{
		$this->db->from('answer');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	/**
     * Realiza el update de una respuesta
     *
     * @return number con el numero de 
     * @param string $where id de la respuesta
     * @param string $data nueva respuesta
    */ 
	public function update($where, $data)
	{
		$this->db->update('answer', $data, $where);
	}

	/**
     * Elimina una respuesta dado un id
     *
     * @param string $id id de la respuesta
    */ 
	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('answer');
	}

	/**
     * Devuelve la pregunta cuyo id conincide con el dado
     *
     * @return object con la pregunta
     * @param string $id id de la pregunta
    */ 
	public function get_question_by_id($id)
	{
		$this->db->select('statement');
		$this->db->from('question');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}


	/*************************** DATATABLES FUNCTIONS *****************************/

	private function _get_datatables_query()
	{
		
		$this->db->from('answer');

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
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']]);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order));
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query('answer');
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
