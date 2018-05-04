<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public $status; 
    public $roles;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_model','category');
        $this->load->library('form_validation');    
        $this->load->helper('form');  
        $this->load->helper('category_helper');
		$this->status = $this->config->item('status'); 
        $this->roles = $this->config->item('roles');   
	}

    /**
     * Metodo index que muestra la vista de las categorias
     * 
    */   
	public function index()
	{
		if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'/main/login/');
        }            

        $titulo['titulo'] = "Categories"; 
        $datos['arrcategories'] = $this->category->get_categories();
        
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        // cargamos la interfaz y le enviamos los datos
        $this->load->view('categories_view', $datos);
	}

    /**
     * Elimina una categoria dado el id
     *
     * @return boolean true si el delete se ha realizado correctamente
     * @param string $id id de la categoria
    */  
    public function delete_category($id)
    {
        $result= $this->category->delete_category_by_id($id);
        if($result)
            echo json_encode(array("status" => TRUE));
        else 
            echo json_encode(array("status" => FALSE));
    }

    /**
     * Añade una nueva categoria 
     *
     * @return boolean true si el add se ha realizado correctamente
    */  
    public function ajax_add()
    {
        $this->_validate();
         
        $number = $this->input->post('number');
        $name = $this->input->post('name');
        $category = $this->input->post('category_id');
            
        $this->category->add_category($number, $name, $category);
        
        echo json_encode(array("status" => TRUE));
    }

    /**
     * Recibe el id de una categoria y devuelve sus datos
     *
     * @return array con los datos de la categoria
     * @param string $id con el id de la categoria
    */  
    public function ajax_edit($id)
    {
        $data = $this->category->get_category_by_id($id);
        
        echo json_encode($data);
    }

    /**
     * Realiza el update de una categoria
     *
     * @return boolean true si el update se ha realizado correctamente
    */  
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'number' => $this->input->post('number'),
                'description' => $this->input->post('name'),
                'num_questions' => NULL,
                'id_parent_category' => $this->input->post('category_id')
                    
            );
        $this->category->update_category(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    /**
     * Valida los campos del input y devuelve los errores
     *
     * @return array con los datos del error
    */  
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('number') == '')
        {
            $data['inputerror'][] = 'number';
            $data['error_string'][] = 'Number is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('name') == '')
        {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'The name is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
