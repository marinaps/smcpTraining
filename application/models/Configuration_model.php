<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
     * Devuelve un array con todas las categorias del final test
     *
     * @return array con las categorias
    */ 
	function get_final_test_categories()
	{
	    $query = $this->db-> query("SELECT id_category from categories_final_test");
	    
		if($query->num_rows() > 0) //si hay resultados los devuelve
		{
			return $query->result_array();
	    }
	}


	/**
     * Realiza el update de una respuesta
     *
     * @return number con el numero de 
     * @param string $where id de la respuesta
     * @param string $data nueva pregunta
    */ 
	public function update_categories($where, $data)
	{
		$this->db->where('id', $where);
		$this->db->update('answer', $data); 
		return $this->db->affected_rows();
	}

}
