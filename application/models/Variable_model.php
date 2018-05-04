<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Variable_model extends CI_Model {

    //Datatables configuration
	var $table = 'type_variable';
	var $column_order = array('variable','id',null); //set column field database for datatable orderable
	var $column_search = array('variable'); //set column field database for datatable searchable just firstname , lastname , address are searchable
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
		$this->db->update('type_variable', $data, $where);
		return $this->db->affected_rows();
	}

	/**
     * Realiza el update de una variable
     *
     * @return number con el numero de 
     * @param string $where id de la variable
     * @param string $data nueva variable
    */ 
	public function update_variable($where, $data) 
	{
		$this->db->where('id', $where);
		$this->db->update('variable', $data); 
		return $this->db->affected_rows();
	}

	/**
     * Elimina un tipo de variable dado su id
     *
     * @param string $id id del tipo de variable
    */ 
	public function delete_type_variable_by_id($id)  
	{
		$this->db->where('id', $id);
		$this->db->delete('type_variable');
	}

	/**
     * Elimina una pregunta dado su id
     *
     * @param string $id id de la pregunta
    */ 
	public function delete_variable_by_id($id)  
	{
		$this->db->where('id', $id);
		$this->db->delete("variable");
	}

	/**
     * Devuelve todos los ejemplos de una variable dado el id del tipo de variable
     *
     * @return object con el nombre de la categoria
     * @param string $id id de la pregunta
    */ 
	public function get_variables($id)   
	{

		$this->db->select('*');
		$this->db->from('variable');
		$this->db->where('id_type_variable',$id);
		$query = $this->db->get();

		return $query->result_array();
	}

	/**
     * Devuelve el nombre del tipo de variable dado su id
     *
     * @return object con el nombre del tipo de variable
     * @param string $id id de la pregunta
    */ 
	public function get_type_variable_name($id) 
	{
		$this->db->select('variable');
		$this->db->from('type_variable');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	/**
     * Recibe el id de un tipo de variable y devuelve sus datos
     *
     * @return array con los datos del tipo de variable
     * @param string $id id del tipo de variable
    */ 
	public function edit($id)
	{

		$this->db->select('type_variable.id,type_variable.variable');
		$this->db->from('type_variable');
		$this->db->where('type_variable.id',$id);
		$this->db->join('variable','variable.id_type_variable=type_variable.id');

		$query=$this->db->get();
		$data=$query->result_array();

		return $data;
	}

	/**
     * Inserta una nueva variable
     *
     * @param string $data con los datos de la variable
    */ 
	public function insert_variable($data)  
	{
		$this->db->insert('variable', $data);
	}

	/*************************** DATATABLES FUNCTIONS *****************************/

    private function _get_datatables_query()
	{
		$this->db->from('type_variable');

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

	private function _get_datatables_query_help()
	{
		//Selecciona todas las variables que tienen ejemplos de nombres concretos

		$this->db->from('type_variable');
		$this->db->where_in('restricted', "1");


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
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function get_datatables_help()
	{
		$this->_get_datatables_query_help();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($help = NULL)
	{
		if($help == NULl)
			$this->_get_datatables_query('type_variable');
		else
			$this->_get_datatables_query_help('type_variable');

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($help = NULL)
	{
		if($help == NULl)
			$this->db->from($this->table);
		else
		{	
			//Selecciona todas las variables que tienen ejemplos de nombres concretos
			$this->db->from('type_variable');
			$this->db->where_in('restricted', "1");
		}

		return $this->db->count_all_results();
	}

	/*************************** END DATATABLES FUNCTIONS *****************************/


}
