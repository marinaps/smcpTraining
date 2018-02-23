<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	/**
     * Devuelve un array con todas las categorias almacenadas en la BD
     *
     * @return array con las categorias
    */ 
	function get_categories()
	{
	    $query = $this->db-> query("SELECT * from category where id_parent_category is NULL");
	    
		if($query->num_rows() > 0) //si hay resultados los devuelve
		{
			return $query->result_array();
	    }
	}



}
