<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

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


	/**
     * Elimina una categoria dado el id
     *
     * @param string $id id de la categoria
    */ 
	function delete($id)
	{
		$this->db->delete('category', array('id' => $id));  //DELETE FROM category WHERE id = $id
	}


	/**
     * Devuelve la respuesta cuyo id conincide con dado
     *
     * @param string $number numero de la categoria
     * @param string $name nombre de la categoria
     * @param string $category id de la categoria padre
    */ 
	function add_category($number, $name, $category)
	{
		//Si no se selecciona una categoria padre se pone a null para indicar que no tiene padre
		if (empty($category)) 
			$category = NULL;

		$data = array(
			        'number' => $number,
			        'description' => $name,
			        'id_parent_category' => $category
					);

		$this->db->insert('category', $data);
	}
	

	/**
     * Realiza el update de una categoria
     *
     * @param string $where id de la categoria que se quiere actualizar
     * @param array $data con los datos a actualizar de la categoria
    */ 
	public function update($where, $data)
	{
		$this->db->set('number', $data['number']);
		$this->db->set('description', $data['description']);
		$this->db->where('id', $where['id']);
		$this->db->update('category');
	}


	/**
     * Devuelve un array con todas los datos de una categoria 
     *
     * @return array con los datos de la categoria
     * @param string $id id de la categoria
    */ 
	public function get_category($id)
	{

		$this->db->from('category');
		$this->db->where('id',$id);
		$query=$this->db->get();
		$data=$query->result_array();

		return $data;
	}

}
