<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Result_model extends CI_Model {

	var $table = 'exam';
	var $column_order = array('date','id',null); //set column field database for datatable orderable
	var $column_search = array('id','date'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{	
		$this->db->from($this->table);

		if($this->session->userdata['role'] != "1")
		{
			$this->db->where('final_test', FALSE);
			$this->db->where('level', '1');
			$this->db->where('id_user', $this->session->userdata['id']);
		}
		else
		{
			$this->db->where('final_test', FALSE);
			$this->db->where('level', '1');
		}

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

	private function _get_datatables_query_association()
	{
		$this->db->from($this->table);

		if($this->session->userdata['role'] != "1")
		{
			$this->db->where('final_test', FALSE);
			$this->db->where('level', '2');
			$this->db->where('id_user', $this->session->userdata['id']);
		}
		else
		{
			$this->db->where('final_test', FALSE);
			$this->db->where('level', '2');
		}

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

	private function _get_datatables_query_final()
	{
		if($this->session->userdata['role'] != "1")
		{
			$this->db->from($this->table);
			$this->db->where('final_test', TRUE);
			$this->db->where('id_user', $this->session->userdata['id']);
		}
		else
		{
			$this->db->from($this->table);
			$this->db->where('final_test', TRUE);
		}

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

	function get_datatables_association()
	{
		$this->_get_datatables_query_association();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function get_datatables_final()
	{
		$this->_get_datatables_query_final();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($level)
	{		

		if($level == "pattern")
			$this->_get_datatables_query();
		

		if($level == "association")
			$this->_get_datatables_query_association();


		if($level == "final")
			$this->_get_datatables_query_final();
		

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($level)
	{
		if($level == "pattern")
		{
			$this->db->from($this->table);
			$this->db->where('final_test', FALSE);
			$this->db->where('level', '1');
		}

		if($level == "association")
		{
			$this->db->from($this->table);
			$this->db->where('final_test', FALSE);
			$this->db->where('level', '2');
		}

		if($level == "final")
		{
			$this->db->from($this->table);
			$this->db->where('final_test', TRUE);
		}


		return $this->db->count_all_results();
	}


	/**
     * Devuelve el nombre del usuario cuyo id conincide con el dado
     *
     * @return object con el nombre del usuario
     * @param string $id id del usuario
    */ 
	public function get_name($id)
	{
		$this->db->select('first_name');
		$this->db->from('users');
		$this->db->where('id',$id);
		
		$query = $this->db->get();

		return $query->row();
	}


	/**
     * Devuelve el apellido del usuario cuyo id conincide con el dado
     *
     * @return object con el apellido del usuario
     * @param string $id id del usuario
    */ 
	public function get_lastname($id)
	{
		$this->db->select('last_name');
		$this->db->from('users');
		$this->db->where('id',$id);
		
		$query = $this->db->get();

		return $query->row();
	}


	/**
     * Devuelve todos los datos de un examen dado su id
     *
     * @return object con los datos del examen
     * @param string $id_exam id del examen
    */ 
	public function get_exam_info($id_exam)
	{
		$this->db->select('*');
		$this->db->from('exam');
		$this->db->where('id', $id_exam);
		
		$query = $this->db->get();

		return $query->row();
	}


	/**
     * Devuelve todas las entries de un examen dado su id
     *
     * @return object con las entries del examen
     * @param string $id_exam id del examen
    */ 
	public function get_disordered_results($id_exam)
	{
		$this->db->select('*');
		$this->db->from('disordered_statement');
		$this->db->join('entry', 'entry.id_question = disordered_statement.id');
		$this->db->where('entry.id_exam', $id_exam);
		$this->db->where('entry.id_type_question', '2');

		$query = $this->db->get();

		return $query->result();
	}

	/**
     * Devuelve todas las entries de un examen dado su id
     *
     * @return object con las entries del examen
     * @param string $id_exam id del examen
    */ 
	public function get_truefalse_results($id_exam)
	{
		$this->db->select('*');
		$this->db->from('true_false_statement');
		$this->db->join('entry', 'entry.id_question = true_false_statement.id');
		$this->db->where('entry.id_exam', $id_exam);
		$this->db->where('entry.id_type_question', '3');
		$query = $this->db->get();

		return $query->result();
	}


	/**
     * Devuelve todas las entries de un examen dado su id
     *
     * @return object con las entries del examen
     * @param string $id_exam id del examen
    */ 
	public function get_audiowrite_results($id_exam)
	{
		$this->db->select('*');
		$this->db->from('question');
		$this->db->join('entry', 'entry.id_question = question.id');
		$this->db->where('entry.id_exam', $id_exam);
		$this->db->where('entry.id_type_question', '4');
		$query = $this->db->get();

		return $query->result();
	}

	/**
     * Devuelve todas las entries de un examen dado su id
     *
     * @return object con las entries del examen
     * @param string $id_exam id del examen
    */ 
	public function get_q_a_results($id_exam)
	{
		$this->db->select('*');
		$this->db->from('question');
		$this->db->join('entry', 'entry.id_question = question.id');
		$this->db->where('entry.id_exam', $id_exam);
		$this->db->where('entry.id_type_question', '1');
		$query = $this->db->get();

		return $query->result();
	}


    /**
     * Devuelve una respuesta correcta al azar de una pregunta segun su id
     *
     * @return object con la respuesta correcta
     * @param string $idquestion id de la pregunta
    */
    public function get_one_correct_answer($idquestion)
    {
        $this->db->select('answer');
        $this->db->from('answer');
        $this->db->where('id_question', $idquestion);
        $this->db->where('correct', '1');
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(1);
        $query = $this->db->get();
        $answer = $query->row_array();

        return $answer;
    }


     /**
     * Devuelve el id del tipo de variables, dada el nombre de la variable
     *
     * @return object con la respuesta correcta
     * @param string $variable id de la pregunta
    */
    public function get_id_type_variable($variable)
    {
        $this->db->select('id');
        $this->db->from('type_variable');
        $this->db->where('variable', $variable);
        
        $result = $this->db->get();
        $sol = $result->row();


        return $sol;
    }

    /**
     * Devuelve una de las variables correctas almacenadas en la bd de la frase/pregunta dado el id de una pregunta
     *
     * @return object con la respuesta correcta
     * @param string $variable id de la pregunta
    */
    public function get_variable_example($id_variable)
    {
        $this->db->select('name');
        $this->db->from('variable');
        $this->db->where('id_type_variable', $id_variable);
        
        $result = $this->db->get();
        $sol = $result->row();

        return $sol;
    }

    /** 
     * Devuelve el nombre de una categoria dado el id de la categoria
     *
     * @return array of objects con el nombre de la categoria
     * @param string $category_id id de la categoria 
    */ 
    public function get_category_name($category_id)
    {
            $this->db->select('number, description');
            $this->db->from('category');
            $this->db->where('id', $category_id);
            $query = $this->db->get();
            
            return $query->row_array();
    }

	
}
