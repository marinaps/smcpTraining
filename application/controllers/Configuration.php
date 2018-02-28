<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends CI_Controller {

	public $status; 
    public $roles;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('configuration_model','configuration');
        $this->load->helper('form');  
        $this->load->library('form_validation');  
        $this->load->helper('category_helper');
		$this->status = $this->config->item('status'); 
        $this->roles = $this->config->item('roles');   
	}

    /**
     * Metodo index que muestra la vista de la configuracion
     * 
    */   
	public function index()
	{
		if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'/main/login/');
        }            

        $titulo['titulo'] = "SMCP-Training Configuration"; 
        
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        // cargamos la interfaz y le enviamos los datos
        $this->load->view('configuration_view');
	}


   /**
     * Devuelve todas las categorias que componen el final test
     *
     * @return array con los las categorias 
    */  
    public function ajax_get_categories_ft()
    {
        $datos['final_test_categories'] = $this->configuration->get_final_test_categories();
        $datos['tam'] = count($datos['final_test_categories']);


        $variable = array( 'categories' => $datos['final_test_categories'], 
                           'tam' => $datos['tam']
                         );

        echo json_encode($variable);
    }

    /**
     * Devuelve todas las categorias que componen el final test
     *
     * @return array con los las categorias 
    */  
    public function update_categories_ft()
    {
        //echo count($_POST['category']);
        if (isset($_POST['categories']))
        {
            $cat = $_POST['categories'];

            //se vacia la tabla categories_final_test
            $this->db->empty_table('categories_final_test'); 
            //se va iterando por cada una de las categorias (input type hidden)
            foreach($cat as $c) 
            {   //si la categoria tiene el checkbox a true, es decir si esta marcada entonces se almacena en la BD
                if($this->input->post('category['.$c.']') )
                {
                    $data = array(
                                'id_category' => $c,
                                );
                    $this->db->insert('categories_final_test', $data);                
                } 
            }   
        }
        //finalmente se redirecciona a la pagina de inicio del controlador configuration
        redirect(site_url().'/configuration/');
    }

  
}
