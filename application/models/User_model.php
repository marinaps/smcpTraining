<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	var $table = 'users';
	var $column_order = array('first_name','last_name','email','status',null); //set column field database for datatable orderable
	var $column_search = array('first_name','last_name','email'); //set column field database for datatable searchable just firstname , lastname , address are searchable
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
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	/**
     * Devuelve el usuario cuyo id conincide con dado
     *
     * @return object con el usuario
     * @param string $id id del usuario
    */ 
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	/**
     * Añade un nuevo usuario
     *
     * @return string id del usuario insertado
     * @param array $data datos del nuevo usuario
    */ 
	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}


	/**
     * Realiza el update de un usuario
     *
     * @return number con el numero de registros actualizados
     * @param string $where id del usuario
     * @param string $data datos del usuario
    */ 
	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}


	/**
     * Elimina un usuario dado un id
     *
     * @param string $id id del usuario
    */ 
	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

	/**
     * Comprueba si se puede eliminar un usuario dado su id
     *
     * @return boolean true si se puede eliminar
     * @param string $id id del usuario
    */ 
	public function get_user_info($id)
	{
		$this->db->from('users');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$row = $query->row();

		if($row->role == "1")
			return FALSE;
		else
			return TRUE;
	}


	/**
     * Devuelve el role del usuario dado su id
     *
     * @return object con el role del usuario
     * @param string $id id del usuario
    */ 
	public function get_role($id)
	{
		$this->db->from('role');
		$this->db->where('id',$id);
		
		$query = $this->db->get();

		return $query->row();
	}

	/* No se utiliza
	public function get_status($id)
	{
		$this->db->from('status');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	*/

	
	/**
     * Comprueba si un email esta ya almacenado en la BD
     *
     * @return boolean true si el email esta ya en la BD
     * @param string $email email del usuario
    */ 
	public function isDuplicate($email)
    {     
        $this->db->get_where('users', array('email' => $email), 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;         
    }
    


    /**
     * Devuelve todas las fechas de los examenes que ha hecho un usuario dado su id
     *
     * @return array con todas las fechas
     * @param string $id con el id de usuario
    */ 
    public function get_graph_data($id)
	{
		$this->db->from('exam');
		$this->db->where('id_user',$id);
		$this->db->order_by('date', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}


    /**
     * Devuelve todas las fechas de los examenes que ha hecho un usuario dado su id
     *
     * @return array con todas las fechas
     * @param string $id con el id de usuario
    */ 
    public function prueba($id)
	{
		$this->db->select('LEFT(date, 10) as sub_id, COUNT(*) as total, id', FALSE);
		$this->db->from('exam');
		$this->db->where('id_user',$id);
		$this->db->group_by('sub_id');
		$query = $this->db->get();

		//return $query->result_array();
		return  $query->result_array();
	}

}
