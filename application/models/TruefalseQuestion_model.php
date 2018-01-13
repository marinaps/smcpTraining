<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TruefalseQuestion_model extends CI_Model {

	var $table = 'true_false_statement';
	var $column_order = array('true_statement', 'id_category', null); //set column field database for datatable orderable
	var $column_search = array('true_statement','false_statement'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

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
		$this->_get_datatables_query($this->table);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query($this->table);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
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
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}


	/**
     * Elimina una pregunta dado un id
     *
     * @param string $id id de la pregunta
    */ 
	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}



	/**
     * Devuelve el nombre de la categoria cuyo id conincide con el dado
     *
     * @return object con el nombre de la categoria
     * @param string $id id de la pregunta
    */ 
	public function get_description($element)
	{

		$this->db->select('description');
		$this->db->from('category');
		$this->db->where('id',$element);
		$query = $this->db->get();

		return $query->row();
	}


	/**
     * Devuelve el numero de la categoria cuyo id conincide con el dado
     *
     * @return object con el numero de la categoria
     * @param string $id id de la pregunta
    */ 
	public function get_number($element)
	{

		$this->db->select('number');
		$this->db->from('category');
		$this->db->where('id',$element);
		$query = $this->db->get();

		return $query->row();
	}

	/**
     * Recibe el id de una pregunta y devuelve sus datos
     *
     * @return array con los datos de la pregunta
     * @param string $id id de la pregunta
    */ 
	public function edit($id)
	{

		$this->db->select('id, true_statement, false_statement, id_category');
		$this->db->from($this->table);
		$this->db->where('id',$id);


		$query=$this->db->get();
		$data=$query->result_array();


		return $data;
	}


}
