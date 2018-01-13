<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_model extends CI_Model {

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
        $query = $this->db->get('category');
        $data = array();

        return $query->result_array();
       
	}


	/**
     * Lee el fichero csv y lo va insertando en la BD para las preguntas desordenadas
     * 
     * @return number con el numero de preguntas que se han insertado
     * @param string $category categorias de las preguntas del csv
    */ 
	function uploadDisordered($category)
    {
	    //get the csv file 
	    $file = $_FILES['userfile']['tmp_name']; 
 
        $handle = fopen($file,"r"); 
        $cont = 0; //cont para saber cuantas filas se han añadido

        //loop through the csv file and insert into database  
        while (($data = fgetcsv($handle, 8000, ";")) !== FALSE)
        {  
            if ($data[0]) 
            { 
                $data = array
                (
			        'ordered' => $data[0],
			        'disordered' => $data[1],
			        'id_category' => $category,
				);
                $this->db->insert('disordered_statement', $data);
                $afftectedRows = $this->db->affected_rows();
                $cont = $cont + $afftectedRows;
            }
        }

        return $cont;
	}

	/**
     * Lee el fichero csv y lo va insertando en la BD para las preguntas de v/f
     * 
     * @return number con el numero de preguntas que se han insertado
     * @param string $category categorias de las preguntas del csv
    */ 
	function uploadTruefalse($category)
    {
	    //get the csv file 
	    $file = $_FILES['userfile']['tmp_name']; 
	 
        $handle = fopen($file,"r"); 
        //loop through the csv file and insert into database 
       
        while (($data = fgetcsv($handle, 8000, ",")) !== FALSE)
        {  
            if ($data[0]) 
            { 
                $data = array
                (
			        'true_statement' => $data[0],
			        'false_statement' => $data[1],
			        'id_category' => $category,
				);
                $this->db->insert('true_false_statement', $data);
            }
        }
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

}
