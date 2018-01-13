<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DisorderedQuestion_model extends CI_Model {

	var $table = 'disordered_statement';
	var $column_order = array('ordered', 'id_category', null); //set column field database for datatable orderable
	var $column_search = array('ordered','disordered'); //set column field database for datatable searchable just firstname , lastname , address are searchable
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
     * @return number con el numero de registros actualizadas
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
	public function get_description($id)
	{

		$this->db->select('description');
		$this->db->from('category');
		$this->db->where('id', $id);
		$query = $this->db->get();

		return $query->row();
	}


	/**
     * Devuelve el numero de la categoria cuyo id conincide con el dado
     *
     * @return object con el numero de la categoria
     * @param string $id id de la pregunta
    */ 
	public function get_number($id)
	{

		$this->db->select('number');
		$this->db->from('category');
		$this->db->where('id', $id);
		$query = $this->db->get();

		return $query->row();
	}


	/**
     * Devuelve el id de la categoria de la pregunta que recibe
     *
     * @return object con el id de la categoria a la que pertenece 
     * @param string $id id de la pregunta
    */ 
	function get_id_category($idquestion)
	{
		$this->db->select('id_category');
		$this->db->from('disordered_statement');
		$this->db->where('id',$idquestion);
		$query = $this->db->get();

		return $query->row()->id_category;
	}


	/**
     * Recibe el id de una pregunta y devuelve sus datos
     *
     * @return array con los datos de la pregunta
     * @param string $id id de la pregunta
    */ 
	public function edit($id)
	{

		$this->db->select('id, ordered, disordered, id_category');
		$this->db->from($this->table);
		$this->db->where('disordered_statement.id',$id);


		$query=$this->db->get();
		$data=$query->result_array();

		return $data;
	}


	/**
     * Aumenta el numero de preguntas de las distintas categorias
     *
     * Recibe el id de la categoria a la que pertenece la pregunta y el numero de 
     * preguntas que se han añadido, y se va aumentando el numero de preguntas en las
     * categorias padre
     *
     * @return array con los datos de la pregunta
     * @param string $idcategory id de la categoria de la pregunta
     * @param number $questions numero de preguntas que se han añadido
    */ 
	function addquestions($idcategory, $questions)
	{
		while($idcategory != null)
		{
			$this->db->select('num_questions')->from('category')->where('id',$idcategory);
			$result = $this->db->get()->row()->num_questions;
			$contador = $questions + $result;
		    $this->db->query("UPDATE category set num_questions = ".$contador." where id=".$idcategory." ");
		    $this->db->select('id_parent_category')->from('category')->where('id',$idcategory);
		    $parent = $this->db->get()->row()->id_parent_category;
		    $idcategory = $parent;
	    }
	}


	/**
     * Disminuye el numero de preguntas de las distintas categorias
     *
     * Recibe el id de la categoria a la que pertenece la pregunta y el numero de 
     * preguntas que se han eliminado, y se va disminuyendo el numero de preguntas en las
     * categorias padre
     *
     * @return array con los datos de la pregunta
     * @param string $idcategory id de la categoria de la pregunta
     * @param number $questions numero de preguntas que se han añadido
    */ 
	function deletequestions($id_category, $questions)
	{
		while($id_category != null)
		{
			$this->db->select('num_questions')->from('category')->where('id',$id_category);
			$result = $this->db->get()->row()->num_questions;
			$contador = $result - $questions;
		    $this->db->query("UPDATE category set num_questions = ".$contador." where id=".$id_category." ");
		    $this->db->select('id_parent_category')->from('category')->where('id',$id_category);
		    $parent = $this->db->get()->row()->id_parent_category;
		    $id_category = $parent;
	    }
	}


}
